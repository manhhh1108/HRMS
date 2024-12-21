@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Profile</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- /Page Header -->
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img class="user-profile" alt="" src="{{ URL::to('/assets/images/'. $users->avatar) }}" alt="{{ $users->name }}"></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{ $users->name }}</h3>
                                            <h6 class="text-muted"> {{ $users->department }}</h6>
                                            <small class="text-muted">{{ $users->position }}</small>
                                            <div class="staff-id">Employee ID : {{ $users->user_id }}</div>
                                            <div class="small doj text-muted">Date of Join : {{ $users->join_date }}</div>
                                            <!-- <div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div> -->
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Phone:</div>
                                                <div class="text">
                                                    @if(!empty($users->phone_number))
                                                    <a>{{ $users->phone_number }}</a>
                                                    @else
                                                    <a>N/A</a>
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Email:</div>
                                                <div class="text">
                                                    @if(!empty($users->email))
                                                    <a>{{ $users->email }}</a>
                                                    @else
                                                    <a>N/A</a>
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Birthday:</div>
                                                <div class="text">
                                                    @if(!empty($users->birth_date))
                                                    <a>{{ $users->birth_date }}</a>
                                                    @else
                                                    <a>N/A</a>
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Address:</div>
                                                <div class="text">
                                                    @if(!empty($users->address))
                                                    <a>{{ $users->address }}</a>
                                                    @else
                                                    <a>N/A</a>
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Gender:</div>
                                                <div class="text">
                                                    @if(!empty($users->gender))
                                                    <a>{{ $users->gender }}</a>
                                                    @else
                                                    <a>N/A</a>
                                                    @endif
                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Reports to:</div>
                                                <div class="text">
                                                    <div class="avatar-box">
                                                        <div class="avatar avatar-xs">
                                                            <img src="{{ URL::to('/assets/images/'. $users->avatar) }}" alt="">
                                                        </div>
                                                    </div>
                                                    <a>{{ $users->line_manager }}</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <!-- Profile Info Tab -->
            <div id="emp_profile" class="pro-overview tab-pane fade show active">
                <div class="row">
                    <div class="col-md-6 d-flex">
                        <div class="card profile-box flex-fill">
                            <div class="card-body">
                                <h3 class="card-title">Emergency Contact <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a></h3>
                                <h5 class="section-title">Primary</h5>
                                <ul class="personal-info">
                                    <li>
                                        <div class="title">Name</div>
                                        @if (!empty($users->name_primary))
                                        <div class="text">{{ $users->name_primary }}</div>
                                        @else
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        <div class="title">Relationship</div>
                                        @if (!empty($users->relationship_primary))
                                        <div class="text">{{ $users->relationship_primary }}</div>
                                        @else
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        <div class="title">Phone </div>
                                        @if (!empty($users->phone_primary) && !empty($users->phone_2_primary))
                                        <div class="text">{{ $users->phone_primary }},{{ $users->phone_2_primary }}</div>
                                        @else
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                </ul>
                                <hr>
                                <h5 class="section-title">Secondary</h5>
                                <ul class="personal-info">
                                    <li>
                                        <div class="title">Name</div>
                                        @if (!empty($users->name_secondary))
                                        <div class="text">{{ $users->name_secondary }}</div>
                                        @else
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        <div class="title">Relationship</div>
                                        @if (!empty($users->relationship_secondary))
                                        <div class="text">{{ $users->relationship_secondary }}</div>
                                        @else
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                    <li>
                                        <div class="title">Phone </div>
                                        @if (!empty($users->phone_secondary) && !empty($users->phone_2_secondary))
                                        <div class="text">{{ $users->phone_secondary }},{{ $users->phone_2_secondary }}</div>
                                        @else
                                        <div class="text">N/A</div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /Profile Info Tab -->


        </div>
    </div>
    <!-- /Page Content -->

    <!-- Profile Modal -->
    <div id="profile_info" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profile Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile/information/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap edit-img">
                                    <img class="inline-block" src="{{ URL::to('/assets/images/'. $users->avatar) }}" alt="{{ $users->name }}">
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" type="file" id="image" name="images">
                                        @if(!empty($users))
                                        <input type="hidden" name="hidden_image" id="e_image" value="{{ $users->avatar }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}">
                                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $users->user_id }}">
                                            <input type="hidden" class="form-control" id="email" name="email" value="{{ $users->email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <div class="cal-icon">
                                                @if(!empty($users))
                                                <input class="form-control datetimepicker" type="text" id="birth_date" name="birth_date" value="{{ $users->birth_date }}">
                                                @else
                                                <input class="form-control datetimepicker" type="text" id="birth_date" name="birth_date">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="select form-control" id="gender" name="gender">
                                                @if(!empty($users))
                                                <option value="{{ $users->gender }}" {{ ( $users->gender == $users->gender) ? 'selected' : '' }}>{{ $users->gender }} </option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                @else
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    @if(!empty($users))
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $users->address }}">
                                    @else
                                    <input type="text" class="form-control" id="address" name="address">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State</label>
                                    @if(!empty($users))
                                    <input type="text" class="form-control" id="state" name="state" value="{{ $users->state }}">
                                    @else
                                    <input type="text" class="form-control" id="state" name="state">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    @if(!empty($users))
                                    <input type="text" class="form-control" id="" name="country" value="{{ $users->country }}">
                                    @else
                                    <input type="text" class="form-control" id="" name="country">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pin Code</label>
                                    @if(!empty($users))
                                    <input type="text" class="form-control" id="pin_code" name="pin_code" value="{{ $users->pin_code }}">
                                    @else
                                    <input type="text" class="form-control" id="pin_code" name="pin_code">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    @if(!empty($users))
                                    <input type="text" class="form-control" id="phoneNumber" name="phone_number" value="{{ $users->phone_number }}">
                                    @else
                                    <input type="text" class="form-control" id="phoneNumber" name="phone_number">
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select class="select" id="department" name="department">
                                        @if(!empty($users))
                                        <option value="{{ $users->department }}" {{ ( $users->department == $users->department) ? 'selected' : '' }}>{{ $users->department }} </option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="IT Management">IT Management</option>
                                        <option value="Marketing">Marketing</option>
                                        @else
                                        <option value="Web Development">Web Development</option>
                                        <option value="IT Management">IT Management</option>
                                        <option value="Marketing">Marketing</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Designation <span class="text-danger">*</span></label>
                                    <select class="select" id="designation" name="designation">
                                        @if(!empty($users))
                                        <option value="{{ $users->designation }}" {{ ( $users->designation == $users->designation) ? 'selected' : '' }}>{{ $users->designation }} </option>
                                        <option value="Web Designer">Web Designer</option>
                                        <option value="Web Developer">Web Developer</option>
                                        <option value="Android Developer">Android Developer</option>
                                        @else
                                        <option value="Web Designer">Web Designer</option>
                                        <option value="Web Developer">Web Developer</option>
                                        <option value="Android Developer">Android Developer</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reports To <span class="text-danger">*</span></label>
                                    <select class="select" id="" name="reports_to">
                                        @if(!empty($users))
                                        <option value="{{ $users->reports_to }}" {{ ( $users->reports_to == $users->reports_to) ? 'selected' : '' }}>{{ $users->reports_to }} </option>
                                        @foreach ($user as $users )
                                        <option value="{{ $users->name }}">{{ $users->name }}</option>
                                        @endforeach
                                        @else
                                        @foreach ($user as $users )
                                        <option value="{{ $users->name }}">{{ $users->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Profile Modal -->

    <!-- Personal Info Modal -->
    <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Personal Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user/information/save') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" name="user_id" value="{{ $users->user_id }}" readonly>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Passport No</label>
                                    <input type="text" class="form-control @error('passport_no') is-invalid @enderror" name="passport_no" value="{{ $users->passport_no }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Passport Expiry Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker @error('passport_expiry_date') is-invalid @enderror" type="text" name="passport_expiry_date" value="{{ $users->passport_expiry_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tel</label>
                                    <input class="form-control @error('tel') is-invalid @enderror" type="text" name="tel" value="{{ $users->tel }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nationality <span class="text-danger">*</span></label>
                                    <input class="form-control @error('nationality') is-invalid @enderror" type="text" name="nationality" value="{{ $users->nationality }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Religion</label>
                                    <div class="form-group">
                                        <input class="form-control @error('religion') is-invalid @enderror" type="text" name="religion" value="{{ $users->religion }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Marital status <span class="text-danger">*</span></label>
                                    <select class="select form-control @error('marital_status') is-invalid @enderror" name="marital_status">
                                        <option value="{{ $users->marital_status }}" {{ ( $users->marital_status == $users->marital_status) ? 'selected' : '' }}> {{ $users->marital_status }} </option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employment of spouse</label>
                                    <input class="form-control @error('employment_of_spouse') is-invalid @enderror" type="text" name="employment_of_spouse" value="{{ $users->employment_of_spouse }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. of children </label>
                                    <input class="form-control @error('children') is-invalid @enderror" type="text" name="children" value="{{ $users->children }}">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Personal Info Modal -->


    <!-- Emergency Contact Modal -->
    <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Personal Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="validation" action="{{ route('user/profile/emergency/contact/save') }}" method="POST">
                        @csrf
                        <input type="text" class="form-control" name="user_id" value="{{ $users->user_id }}">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Primary Contact</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            @if (!empty($users->name_primary))
                                            <input type="text" class="form-control" name="name_primary" value="{{ $users->name_primary }}">
                                            @else
                                            <input type="text" class="form-control" name="name_primary">
                                            @endif
                                            </li>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship <span class="text-danger">*</span></label>
                                            @if (!empty($users->relationship_primary))
                                            <input type="text" class="form-control" name="relationship_primary" value="{{ $users->relationship_primary }}">
                                            @else
                                            <input type="text" class="form-control" name="relationship_primary">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone <span class="text-danger">*</span></label>
                                            @if (!empty($users->phone_primary))
                                            <input type="text" class="form-control" name="phone_primary" value="{{ $users->phone_primary }}">
                                            @else
                                            <input type="text" class="form-control" name="phone_primary">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone 2</label>
                                            @if (!empty($users->phone_2_primary))
                                            <input type="text" class="form-control" name="phone_2_primary" value="{{ $users->phone_2_primary }}">
                                            @else
                                            <input type="text" class="form-control" name="phone_2_primary">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Secondary Contact</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            @if (!empty($users->name_secondary))
                                            <input type="text" class="form-control" name="name_secondary" value="{{ $users->name_secondary }}">
                                            @else
                                            <input type="text" class="form-control" name="name_secondary">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Relationship <span class="text-danger">*</span></label>
                                            @if (!empty($users->relationship_secondary))
                                            <input type="text" class="form-control" name="relationship_secondary" value="{{ $users->relationship_secondary }}">
                                            @else
                                            <input type="text" class="form-control" name="relationship_secondary">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone <span class="text-danger">*</span></label>
                                            @if (!empty($users->phone_secondary))
                                            <input type="text" class="form-control" name="phone_secondary" value="{{ $users->phone_secondary }}">
                                            @else
                                            <input type="text" class="form-control" name="phone_secondary">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone 2</label>
                                            @if (!empty($users->phone_2_secondary))
                                            <input type="text" class="form-control" name="phone_2_secondary" value="{{ $users->phone_2_secondary }}">
                                            @else
                                            <input type="text" class="form-control" name="phone_2_secondary">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Emergency Contact Modal -->




    <!-- /Page Content -->
</div>
@section('script')
<script>
    $('#validation').validate({
        rules: {
            name_primary: 'required',
            relationship_primary: 'required',
            phone_primary: 'required',
            phone_2_primary: 'required',
            name_secondary: 'required',
            relationship_secondary: 'required',
            phone_secondary: 'required',
            phone_2_secondary: 'required',
        },
        messages: {
            name_primary: 'Please input name primary',
            relationship_primary: 'Please input relationship primary',
            phone_primary: 'Please input phone primary',
            phone_2_primary: 'Please input phone 2 primary',
            name_secondary: 'Please input name secondary',
            relationship_secondary: 'Please input relationship secondary',
            phone_secondaryr: 'Please input phone secondary',
            phone_2_secondary: 'Please input phone 2 secondary',
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script>
@endsection
@endsection