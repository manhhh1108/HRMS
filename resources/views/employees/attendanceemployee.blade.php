@extends('layouts.master')
@section('content')
@if (session('flash_notification.message'))
<div class="alert alert-{{ session('flash_notification.level') }}">
    {{ session('flash_notification.message') }}
</div>
@endif
<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Attendance</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-4">
                <div class="card timesheet-status">
                    <div class="card-body">
                        <h5 class="card-title">Timesheet <small id="current-date" class="text-muted">{{ \Carbon\Carbon::today()->toFormattedDateString() }}</small></h5>

                        <!-- Check In Section -->
                        <div class="checkin-section text-center my-3">
                            <h6>Check In at</h6>
                            <p id="checkin-time">
                                {{ $attendanceToday->check_in_time ?? '--:--' }}
                            </p>
                            @if($attendanceToday && !$attendanceToday->check_in_time)
                            <button id="checkin-btn" type="button" class="btn btn-primary checkin-btn mt-2">Check In</button>
                            @else
                            <button id="checkin-btn" type="button" class="btn btn-secondary checkin-btn mt-2" disabled>Checked In</button>
                            @endif
                        </div>
                        <hr />

                        <!-- Check Out Section -->
                        <div class="checkout-section text-center my-3">
                            <h6>Check Out at</h6>
                            <p id="checkout-time">
                                {{ $attendanceToday->check_out_time ?? '--:--' }}
                            </p>
                            @if($attendanceToday && $attendanceToday->check_in_time && !$attendanceToday->check_out_time)
                            <button id="checkout-btn" type="button" class="btn btn-secondary checkout-btn mt-2">Check Out</button>
                            @else
                            <button id="checkout-btn" type="button" class="btn btn-secondary checkout-btn mt-2" disabled>Checked Out</button>
                            @endif
                        </div>
                        <hr />

                        <!-- Work Hours Section -->
                        <div class="time-info text-center my-3">
                            <h6>Total Hours</h6>
                            <span id="total-hours" class="font-weight-bold">
                                {{ $attendanceToday ? $attendanceToday->work_hours : '0' }} hrs
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card att-statistics">
                    <div class="card-body">
                        <h5 class="card-title">Statistics</h5>
                        <div class="stats-list">
                            <div class="stats-info">
                                <p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="stats-info">
                                <p>Overtime <strong>4</strong></p>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card recent-activity">
                    <div class="card-body">
                        <h5 class="card-title">Today Activity</h5>
                        <ul class="res-activity-list">
                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    10.00 AM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch Out at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    11.00 AM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    11.15 AM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch Out at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    1.30 PM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    2.00 PM.
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch Out at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    7.30 PM.
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Filter -->
        <div class="row filter-row">
            <div class="col-sm-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input type="text" class="form-control floating datetimepicker" id="date-picker" placeholder="DD-MM-YYYY">
                    </div>
                    <label class="focus-label">Date</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" id="month-select">
                        <option value="">-</option>
                        <option value="01">Jan</option>
                        <option value="02">Feb</option>
                        <option value="03">Mar</option>
                        <option value="04">Apr</option>
                        <option value="05">May</option>
                        <option value="06">Jun</option>
                        <option value="07">Jul</option>
                        <option value="08">Aug</option>
                        <option value="09">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select>
                    <label class="focus-label">Select Month</label>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" id="year-select">
                        <option value="">-</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                    </select>
                    <label class="focus-label">Select Year</label>
                </div>
            </div>
            <div class="col-sm-3">
                <a href="#" class="btn btn-success btn-block" id="search-btn">Search</a>
            </div>
        </div>

        <!-- /Search Filter -->

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Work Hours</th> <!-- Thay "Production" thành "Work Hours" vì dữ liệu bạn có là số giờ làm việc -->
                                <th>Status</th> <!-- Thay "Break" thành "Status" (vì nếu có thể có trạng thái như nghỉ phép, nghỉ ốm) -->
                                <th>Overtime</th> <!-- Overtime tính từ số giờ làm việc nếu vượt quá 8 giờ -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendanceList as $attendance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->check_in_time)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($attendance->check_out_time)->format('h:i A') }}</td>
                                <td>{{ $attendance->work_hours }} hrs</td>

                                <td>
                                    @if($attendance->status)
                                    {{ $attendance->status }} <!-- Trạng thái nếu có -->
                                    @else
                                    N/A <!-- Nếu không có trạng thái -->
                                    @endif
                                </td>

                                <td>
                                    @if($attendance->work_hours > 8) <!-- Giả sử 8 giờ là chuẩn -->
                                    {{ $attendance->work_hours - 8 }} hrs
                                    @else
                                    0 hrs
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
    <!-- /Page Content -->

</div>
<!-- /Page Content -->


</div>
<script>
    const employeeId = @json(session('user_id'));
    console.log(employeeId);

    document.addEventListener("DOMContentLoaded", () => {
        const checkinBtn = document.getElementById("checkin-btn");
        const checkoutBtn = document.getElementById("checkout-btn");
        const checkinTime = document.getElementById("checkin-time");
        const checkoutTime = document.getElementById("checkout-time");
        const totalHours = document.getElementById("total-hours");
        const currentDate = document.getElementById("current-date");

        let checkinDateTime = null;
        let checkoutDateTime = null;

        // Update current date and time with seconds
        function updateCurrentDateTime() {
            const now = new Date();
            currentDate.textContent = now.toLocaleString("en-US", {
                weekday: "short",
                day: "numeric",
                month: "short",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
            });
        }

        // Format time as HH:MM:SS AM/PM
        function formatTime(date) {
            return date.toLocaleTimeString("en-US", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
            });
        }

        // Calculate total hours
        function calculateTotalHours() {
            if (checkinDateTime && checkoutDateTime) {
                const diff = (checkoutDateTime - checkinDateTime) / (1000 * 60 * 60); // Convert ms to hours
                totalHours.textContent = `${diff.toFixed(2)} hrs`;
            }
        }

        // Real-time clock update
        function startRealTimeClock() {
            setInterval(() => {
                updateCurrentDateTime();
            }, 1000);
        }

        // Check In button click event
        checkinBtn.addEventListener("click", async () => {
            const now = new Date();
            checkinDateTime = now;

            // Cập nhật UI
            checkinTime.textContent = `${now.toDateString()} ${formatTime(now)}`;

            try {

                const response = await fetch('/attendance/checkin', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        employee_id: employeeId // Thay bằng ID nhân viên cần thiết
                    }),
                });

                // Kiểm tra mã lỗi phản hồi (400 hoặc 200)
                if (response.status === 200) {
                    // Nếu check-in thành công, reload trang
                    location.reload(); // Reload trang để hiển thị thông báo flash
                } else {
                    const data = await response.json();
                    // Xử lý thông báo lỗi nếu có
                    alert(data.flash || 'Có lỗi xảy ra!');
                }
            } catch (error) {
                console.log('Error:', error); // Debug lỗi nếu có
            }
        });


        // Check Out button click event
        checkoutBtn.addEventListener("click", async () => {
            const now = new Date();
            checkoutDateTime = now;

            checkoutTime.textContent = `${now.toDateString()} ${formatTime(now)}`;
            calculateTotalHours();

            try {
                const response = await fetch('/attendance/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        employee_id: employeeId
                    }),
                });

                if (response.status === 200) {
                    location.reload();
                } else {
                    const data = await response.json();
                    alert(data.flash || 'Có lỗi xảy ra!');
                }
            } catch (error) {
                console.log('Error:', error);
            }
        });


        updateCurrentDateTime();
        startRealTimeClock();
    });
    window.onload = function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            alert(flashMessage.textContent);
        }
    }
</script>
<script>
    $(document).ready(function() {
        // Initialize the datepicker
        $('#date-picker').datepicker({
            format: 'dd-mm-yyyy', // Set the date format to DD-MM-YYYY
            autoclose: true
        });

        // Handle click event on the search button
        $('#search-btn').on('click', function(e) {
            e.preventDefault();

            // Get selected values from date, month, and year
            var date = $('#date-picker').val();
            var month = $('#month-select').val();
            var year = $('#year-select').val();

            // Perform search based on the selected filters
            searchAttendance(date, month, year);
        });
    });

    // Function to handle the search action
    function searchAttendance(date, month, year) {
        // Prepare the query parameters
        var queryParams = {};

        if (date) {
            queryParams.date = date; // Pass the date in the query
        }
        if (month) {
            queryParams.month = month; // Pass the month in the query
        }
        if (year) {
            queryParams.year = year; // Pass the year in the query
        }

        // You can either use AJAX or simply reload the page with the query parameters.
        // Here, we reload the page with the query parameters
        var searchUrl = '/attendance/search?' + $.param(queryParams);
        window.location.href = searchUrl; // Redirect to the search URL with query parameters
    }
</script>

<!-- /Page Wrapper -->
@section('script')
@endsection
@endsection