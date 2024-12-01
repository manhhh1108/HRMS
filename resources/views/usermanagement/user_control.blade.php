@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Quản lý người dùng</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Người dùng</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Thêm người dùng</a>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->

            <!-- Search Filter -->
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">  
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" id="user_name" name="user_name">
                        <label class="focus-label">Tên người dùng</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3"> 
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="type_role"> 
                            <option selected disabled>-- Select Role  --</option>
                            @foreach ($role_name as $name)
                                <option value="{{ $name->role_type }}">{{ $name->role_type }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Role </label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3"> 
                    <div class="form-group form-focus select-focus">
                        <select class="select floating" id="type_status"> 
                            <option selected disabled> --Select --</option>
                            @foreach ($status_user as $status )
                            <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                            @endforeach
                        </select>
                        <label class="focus-label">Trạng thái</label>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">  
                    <button type="sumit" class="btn btn-success btn-block btn_search"> Tìm kiếm </button>  
                </div>
            </div>

              

            <!-- /Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table" id="userDataList" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tên</th>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>Vị trí</th>
                                    <th>Sđt</th>
                                    <th>Ngày tham gia</th>
                                    <th>Đăng nhập lần cuối</th>
                                    <th>Role</th>
                                    <th>Trạng thái</th>
                                    <th>Phòng ban</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add User Modal -->
        <div id="add_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm người dùng mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user/add/save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="" name="name" value="{{ old('name') }}" placeholder="Nhập Name">
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Emaill </label>
                                    <input class="form-control" type="email" id="" name="email" placeholder="Nhập Email">
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <label>Role </label>
                                    <select class="select" name="role_name" id="role_name">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($role_name as $role )
                                        <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Vị trí</label>
                                    <select class="select" name="position" id="position">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($position as $positions )
                                        <option value="{{ $positions->position }}">{{ $positions->position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Sđt</label>
                                        <input class="form-control" type="tel" id="" name="phone" placeholder="Nhập Sđt">
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Phòng ban</label>
                                    <select class="select" name="department" id="department">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($department as $departments )
                                        <option value="{{ $departments->department }}">{{ $departments->department }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <label>Trạng thái</label>
                                    <select class="select" name="status" id="status">
                                        <option selected disabled> --Select --</option>
                                        @foreach ($status_user as $status )
                                        <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Ảnh</label>
                                    <input class="form-control" type="file" id="image" name="image">
                                </div>
                            </div>
                            <br>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Choose Repeat Password">
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
        <!-- /Add User Modal -->
				
        <!-- Edit User Modal -->
        <div id="edit_user" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chỉnh sửa người dùng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div class="modal-body">
                        <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" id="e_id">
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Tên</label>
                                        <input class="form-control" type="text" name="name" id="e_name" value="" />
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" id="e_email" value="" />
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <label>Role </label>
                                    <select class="select" name="role_name" id="e_role_name">
                                        @foreach ($role_name as $role )
                                        <option value="{{ $role->role_type }}">{{ $role->role_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Vị trí</label>
                                    <select class="select" name="position" id="e_position">
                                        @foreach ($position as $positions )
                                        <option value="{{ $positions->position }}">{{ $positions->position }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <div class="form-group">
                                        <label>Sđt</label>
                                        <input class="form-control" type="text" id="e_phone_number" name="phone" placeholder="Nhập sđt">
                                    </div>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Phòng ban</label>
                                    <select class="select" name="department" id="e_department">
                                        @foreach ($department as $departments )
                                        <option value="{{ $departments->department }}">{{ $departments->department }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-sm-6"> 
                                    <label>Trạng thái</label>
                                    <select class="select" name="status" id="e_status">
                                        @foreach ($status_user as $status )
                                        <option value="{{ $status->type_name }}">{{ $status->type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-6"> 
                                    <label>Ảnh</label>
                                    <input class="form-control" type="file" id="image" name="images">
                                    <input type="hidden" name="hidden_image" id="e_image" value="">
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                </div>

                            </div>
                            <br>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit Salary Modal -->
				
        <!-- Delete User Modal -->
        <div class="modal custom-modal fade" id="delete_user" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Xóa người dùng</h3>
                            <p>Bạn có muốn xóa người dùng này ko?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('user/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <input type="hidden" name="avatar" id="e_avatar" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Xóa</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Hủy</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete User Modal -->
    </div>
    <!-- /Page Wrapper -->
@section('script')

    <script type="text/javascript">
        $(document).ready(function() {
            const table = $('#userDataList').DataTable({
                lengthMenu: [
                    [10, 25, 50, 100, 150],
                    [10, 25, 50, 100, 150]
                ],
                buttons: ['pageLength'],
                pageLength: 10,
                order: [[5, 'desc']],
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                ajax: {
                    url: "{{ route('get-users-data') }}",
                    data: function(data) {
                        data.user_name = $('#user_name').val();
                        data.type_role = $('#type_role').val();
                        data.type_status = $('#type_status').val();
                    }
                },
                columns: [
                    { data: 'no' },
                    { data: 'name' },
                    { data: 'user_id' },
                    { data: 'email' },
                    { data: 'position' },
                    { data: 'phone_number' },
                    { data: 'join_date' },
                    { data: 'last_login' },
                    { data: 'role_name' },
                    { data: 'status' },
                    { data: 'department' },
                    { data: 'action' }
                ]
            });
    
            $('.btn_search').on('click', function() {
                table.draw();
            });
        });
    </script>
    <script>
        $(document).on('click', '.userUpdate', function() {
            const _this = $(this).closest('tr');
            $('#e_id').val(_this.find('.user_id').text());
            $('#e_name').val(_this.find('.name').text());
            $('#e_email').val(_this.find('.email').text());
            $('#e_role_name').val(_this.find('.role_name').text()).change();
            $('#e_position').val(_this.find('.position').text()).change();
            $('#e_phone_number').val(_this.find('.phone_number').text());
            $('#e_department').val(_this.find('.department').text());
            $('#e_status').val(_this.find('.status_s').text()).change();
            $('#e_image').val(_this.find('.avatar').data('avatar'));
        });
    
        $(document).on('click', '.userDelete', function() {
            const _this = $(this).closest('tr');
            $('.e_id').val(_this.find('.id').data('id'));
            $('#e_avatar').val(_this.find('.avatar').data('avatar'));
        });
    </script>

@endsection
@endsection
