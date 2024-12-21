<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    const ATTENDANCE_PRESENT = 2;        // Nhân viên có mặt đầy đủ trong ngày (check-in và check-out đầy đủ)
    const ATTENDANCE_HALF_DAY = 1;       // Nhân viên làm việc nửa ngày (check-in nhưng không check-out đầy đủ)
    const ATTENDANCE_ABSENT = 0;         // Nhân viên vắng mặt (không có bản ghi check-in)
    const ATTENDANCE_LATE = 3;           // Nhân viên đến muộn nhưng vẫn check-in
    const ATTENDANCE_EARLY_LEAVE = 4;    // Nhân viên về sớm (check-in đầy đủ nhưng không hoàn thành đủ thời gian làm việc)
    const ATTENDANCE_OVERTIME = 5;       // Nhân viên làm thêm giờ (check-in và check-out nhưng thời gian làm việc vượt quá giờ làm việc chuẩn)
    const ATTENDANCE_EXCUSED = 6;        // Nhân viên vắng mặt có phép (nghỉ ốm, nghỉ phép, có lý do chính đáng)
    const ATTENDANCE_UNEXCUSED = 7;      // Nhân viên vắng mặt không phép (vắng mặt mà không có lý do hợp lệ)
    const ATTENDANCE_HOLIDAY = 8;        // Ngày nghỉ (ngày nghỉ lễ, ngày nghỉ theo lịch công ty)
    const ATTENDANCE_PENDING = 9;        // Đang chờ duyệt (trạng thái này có thể sử dụng khi chấm công đang chờ phê duyệt)
    
    
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'date',
        'check_in_time',
        'check_out_time',
        'work_hours',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
        'check_in_time' => 'datetime:H:i:s',
        'check_out_time' => 'datetime:H:i:s',
        'work_hours' => 'float',
        'status' => 'integer',
    ];

    /**
     * Relationship with Employee model.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Calculate work hours between check-in and check-out.
     *
     * @return float|null
     */
    public function calculateWorkHours(): ?float
    {
        if ($this->check_in_time && $this->check_out_time) {
            $checkIn = Carbon::createFromFormat('H:i:s', $this->check_in_time);
            $checkOut = Carbon::createFromFormat('H:i:s', $this->check_out_time);
            return $checkOut->diffInMinutes($checkIn) / 60;
        }

        return null;
    }
}
