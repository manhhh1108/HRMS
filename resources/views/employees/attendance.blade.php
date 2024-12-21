@extends('layouts.master')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
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

        <!-- Search Filter -->
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating">
                    <label class="focus-label">Employee Name</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option>-</option>
                        <option>Jan</option>
                        <option>Feb</option>
                        <option>Mar</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>Jun</option>
                        <option>Jul</option>
                        <option>Aug</option>
                        <option>Sep</option>
                        <option>Oct</option>
                        <option>Nov</option>
                        <option>Dec</option>
                    </select>
                    <label class="focus-label">Select Month</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating">
                        <option>-</option>
                        <option>2019</option>
                        <option>2018</option>
                        <option>2017</option>
                        <option>2016</option>
                        <option>2015</option>
                    </select>
                    <label class="focus-label">Select Year</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <a href="#" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
        <!-- /Search Filter -->

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                @for ($day = 1; $day <= 31; $day++)
                                    <th>{{ $day }}</th>
                                    @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar avatar-xs" href="profile.html">
                                            <img alt="" src="{{ URL::to('assets/img/profiles/avatar-09.jpg') }}">
                                        </a>
                                        <a href="profile.html">{{ $employee->name }}</a>
                                    </h2>
                                </td>
                                @for ($day = 1; $day <= 31; $day++)
                                    @php
                                    $attendance=$attendanceData[$employee->employee_id][$day] ?? null;
                                    @endphp
                                    <td>
                                        @if ($attendance)
                                        @php
                                        $entry = $attendance->first(); // Get the first (and only) record for the day
                                        @endphp
                                        <div class="attendance-status">
                                            @switch($entry->status)
                                            @case($attendanceStatuses['ATTENDANCE_PRESENT'])
                                            <a href="javascript:void(0);"
                                                data-toggle="modal"
                                                data-target="#attendance_info"
                                                data-date="{{$entry->date}}"
                                                data-punchin="{{ $entry->check_in_time ?? 'N/A' }}"
                                                data-work_hours="{{ $entry->work_hours ?? '0' }}"
                                                data-punchout="{{ $entry->check_out_time ?? 'N/A' }}"
                                                data-overtime="{{ $entry->overtime ?? 'N/A' }}"
                                                data-break="{{ $entry->break ?? 'N/A' }}">
                                                <i class="fa fa-check text-success"></i>
                                            </a>
                                            @break
                                            @case($attendanceStatuses['ATTENDANCE_HALF_DAY'])
                                            <a href="javascript:void(0);"
                                                data-toggle="modal"
                                                data-target="#attendance_info"
                                                data-date="{{$entry->date}}"
                                                data-punchin="{{ $entry->check_in_time ?? 'N/A' }}"
                                                data-work_hours="{{ $entry->work_hours ?? '0' }}"
                                                data-punchout="{{ $entry->check_out_time ?? 'N/A' }}"
                                                data-overtime="{{ $entry->overtime ?? 'N/A' }}"
                                                data-break="{{ $entry->break ?? 'N/A' }}">
                                                <i class="fa fa-check text-success"></i>
                                            </a>
                                            <span><i class="fa fa-close text-danger"></i></span>
                                            @break
                                            @case($attendanceStatuses['ATTENDANCE_EARLY_LEAVE'])
                                            <a href="javascript:void(0);"
                                                data-toggle="modal"
                                                data-target="#attendance_info"
                                                data-date="{{$entry->date}}"
                                                data-punchin="{{ $entry->check_in_time ?? 'N/A' }}"
                                                data-work_hours="{{ $entry->work_hours ?? '0' }}"
                                                data-punchout="{{ $entry->check_out_time ?? 'N/A' }}"
                                                data-overtime="{{ $entry->overtime ?? 'N/A' }}"
                                                data-break="{{ $entry->break ?? 'N/A' }}">
                                                <i class="fa fa-sign-out-alt text-primary"></i>
                                            </a>
                                            @break
                                            @case($attendanceStatuses['ATTENDANCE_ABSENT'])
                                            <a href="javascript:void(0);"
                                                data-toggle="modal"
                                                data-target="#attendance_info"
                                                data-date="{{$entry->date}}"
                                                data-punchin="{{ $entry->check_in_time ?? 'N/A' }}"
                                                data-work_hours="{{ $entry->work_hours ?? '0' }}"
                                                data-punchout="{{ $entry->check_out_time ?? 'N/A' }}"
                                                data-overtime="{{ $entry->overtime ?? 'N/A' }}"
                                                data-break="{{ $entry->break ?? 'N/A' }}">
                                                <i class="fa fa-close text-danger"></i>
                                            </a>
                                            @break
                                            @default
                                            <i class="fa fa-question-circle text-secondary"></i>
                                            @endswitch
                                        </div>
                                        @else
                                        <i class="fa fa-close text-danger"></i> <!-- No attendance data available -->
                                        @endif
                                    </td>
                                    @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Attendance Modal -->
    <div class="modal custom-modal fade" id="attendance_info" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Info for <span id="attendance_date"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card punch-status">
                                <div class="card-body">
                                    <h5 class="card-title">Timesheet <small class="text-muted" id="attendance_day"></small></h5>
                                    <div class="punch-det">
                                        <h6>Punch In at</h6>
                                        <p id="punchin_time">N/A</p>
                                    </div>
                                    <div class="punch-info">
                                        <div class="punch-hours">
                                            <span id="overtime_hours">0 hrs</span>
                                        </div>
                                    </div>
                                    <div class="punch-det">
                                        <h6>Punch Out at</h6>
                                        <p id="punchout_time">N/A</p>
                                    </div>
                                    <div class="statistics">
                                        <div class="row">
                                            <div class="col-md-6 col-6 text-center">
                                                <div class="stats-box">
                                                    <p>Break</p>
                                                    <h6 id="break_time">0 hrs</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center">
                                                <div class="stats-box">
                                                    <p>Overtime</p>
                                                    <h6 id="overtime_time">0 hrs</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card recent-activity">
                                <div class="card-body">
                                    <h5 class="card-title">Activity</h5>
                                    <ul class="res-activity-list">
                                        <li>
                                            <p class="mb-0">Punch In at</p>
                                            <p class="res-activity-time" id="activity_punchin">
                                                <i class="fa fa-clock-o"></i>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="mb-0">Punch Out at</p>
                                            <p class="res-activity-time" id="activity_punchout">
                                                <i class="fa fa-clock-o"></i>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Attendance Modal -->

</div>
<script>
    $(document).ready(function() {
        // Attach click event listener to the modal trigger link
        $('a[data-toggle="modal"]').on('click', function(event) {
            // Get the data-* attributes from the clicked link
            var button = $(this);
            var date = button.data('date');
            var punchin = button.data('punchin');
            var punchout = button.data('punchout');
            var overtime = button.data('overtime');
            var breaktime = button.data('break');
            var overtime_hours_time = button.data('work_hours');

            // Log the data for debugging
            console.log(punchin);
            console.log(punchout);

            // Populate the modal with the data
            $('#attendance_info').find('#attendance_date').text(date);
            $('#attendance_info').find('#punchin_time').text(punchin);
            $('#attendance_info').find('#punchout_time').text(punchout);
            $('#attendance_info').find('#overtime_time').text(overtime);
            $('#attendance_info').find('#break_time').text(breaktime);
            $('#attendance_info').find('#overtime_hours').text(overtime_hours_time + ' hrs');
            $('#attendance_info').find('#activity_punchin').text(punchin);
            $('#attendance_info').find('#activity_punchout').text(punchout);
        });
    });
</script>
<!-- Page Wrapper -->
@endsection