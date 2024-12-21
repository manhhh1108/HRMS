<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    /** Attendance Admin */
    public function attendanceIndex()
    {
        $attendanceStatuses = [
            'ATTENDANCE_PRESENT' => 1,
            'ATTENDANCE_HALF_DAY' => 2,
            'ATTENDANCE_EARLY_LEAVE' => 3,
            'ATTENDANCE_ABSENT' => 4,
        ];

        // Lấy tất cả nhân viên
        $employees = Employee::all();

        // Lấy thông tin chấm công cho tất cả nhân viên trong tháng hiện tại
        $attendanceData = [];
        $currentMonth = Carbon::now()->month;

        foreach ($employees as $employee) {
            $attendances = Attendance::where('employee_id', $employee->employee_id)
                ->whereMonth('date', $currentMonth)
                ->get();

            // Nhóm thông tin chấm công theo ngày
            $attendanceData[$employee->employee_id] = $attendances->groupBy(function ($attendance) {
                return Carbon::parse($attendance->date)->day;
            });
        }

        Log::info(json_encode($attendanceData));
        return view('employees.attendance', compact('employees', 'attendanceData', 'attendanceStatuses'));
    }


    /** Attendance Employee */
    public function attendanceEmployee()
    {
        // Lấy employee_id từ user hiện tại
        $employee_id = auth()->user()->user_id;

        // Lấy danh sách chấm công trước ngày hôm nay
        $attendanceList = Attendance::where('employee_id', $employee_id)
            ->whereDate('date', '<', Carbon::today())
            ->get();

        // Lấy thông tin chấm công hôm nay
        $attendanceToday = Attendance::where('employee_id', $employee_id)
            ->whereDate('date', Carbon::today())
            ->first();

        // Tính số giờ làm việc trong ngày hôm nay
        $todayWorkHours = $attendanceToday ? $attendanceToday->work_hours : 0;

        // Tính tổng số giờ làm việc trong tuần này
        $weekWorkHours = Attendance::where('employee_id', $employee_id)
            ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('work_hours');

        // Tính tổng số giờ làm việc trong tháng này
        $monthWorkHours = Attendance::where('employee_id', $employee_id)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('work_hours');

        // Giả sử số giờ làm việc chuẩn mỗi tháng là 160 giờ
        $remainingWorkHours = 160 - $monthWorkHours;

        // Tính tổng số giờ làm thêm (nếu có trường "is_overtime" đánh dấu giờ làm thêm)
        $overtimeHours = 0;
        // Trả về view với tất cả các dữ liệu cần thiết
        return view('employees.attendanceemployee', compact(
            'attendanceList',
            'attendanceToday',
            'todayWorkHours',
            'weekWorkHours',
            'monthWorkHours',
            'remainingWorkHours',
            'overtimeHours'
        ));
    }



    /**
     * Handle employee check-in.
     */
    public function checkIn(Request $request)
    {
        // Xác thực ID nhân viên
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
        ]);

        $existingAttendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', Carbon::today())
            ->first();

        if ($existingAttendance && $existingAttendance->check_in_time) {
            flash('Đã check-in hôm nay rồi.', 'error');
            return;
        }

        // Tạo mới hoặc cập nhật thông tin check-in
        $attendance = Attendance::updateOrCreate(
            [
                'employee_id' => $request->employee_id,
                'status' => Attendance::ATTENDANCE_PRESENT, // Đặt trạng thái check-in là "present"
                'date' => Carbon::today(),
            ],
            [
                'check_in_time' => Carbon::now()->format('H:i:s'),
            ]
        );

        // Thông báo check-in thành công
        flash('Check-in thành công!', 'success');
    }

    public function checkOut(Request $request)
    {
        // Validate the request
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
        ]);

        // Find today's attendance record
        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->whereDate('date', Carbon::today())
            ->first();

        // Kiểm tra nếu không có bản ghi check-in hôm nay
        if (!$attendance || !$attendance->check_in_time) {
            flash('Check-in không tìm thấy cho hôm nay.', 'error');
            return;
        }

        // Cập nhật thông tin check-out và tính giờ làm việc
        try {
            $checkInTime = Carbon::parse($attendance->check_in_time); // Tự động xử lý ngày giờ
        } catch (\Exception $e) {
            flash('Định dạng thời gian check-in không hợp lệ.', 'error');
            return;
        }

        $checkOutTime = Carbon::now();

        $workHours = $checkOutTime->diffInHours($checkInTime);

        $workHours = abs($workHours); // Lấy giá trị tuyệt đối nếu có giá trị âm
        $workHours = round($workHours);  // Làm tròn đến số nguyên gần nhất (1.5 => 2 hoặc 1.4 => 1)

        // Cập nhật trạng thái
        $status = Attendance::ATTENDANCE_ABSENT; // Mặc định là vắng mặt
        if ($workHours >= 8) {
            $status = Attendance::ATTENDANCE_PRESENT; // Trạng thái "present" nếu làm đủ 8 giờ
        } elseif ($workHours >= 4) {
            $status = Attendance::ATTENDANCE_HALF_DAY; // Trạng thái "half day" nếu làm từ 4 đến 7 giờ
        } elseif ($workHours < 4 && $workHours > 0) {
            $status = Attendance::ATTENDANCE_EARLY_LEAVE; // Trạng thái "early leave" nếu làm ít hơn 4 giờ
        }

        // Cập nhật bản ghi chấm công với thời gian check-out và trạng thái
        $attendance->update([
            'check_out_time' => $checkOutTime->format('H:i:s'),
            'work_hours' => $workHours,
            'status' => $status,  // Cập nhật trạng thái sau khi tính toán
        ]);

        // Lưu thông báo thành công vào session
        flash('Check-out thành công!', 'success');
    }
}
