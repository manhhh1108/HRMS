@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="account-content">
            <a href="{{ route('form/job/list') }}" class="btn btn-primary apply-btn">Apply Job</a>
            <div class="container">
                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Đăng ký</h3>
                        
                        
                        <!-- Account Form -->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nhập tên">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Nhập email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- insert defaults --}}
                            <input type="hidden" class="image" name="image" value="photo_defaults.jpg">
                            <div class="form-group">
                                <label class="col-form-label">Role </label>
                                <select class="select @error('role_name') is-invalid @enderror" name="role_name" id="role_name">
                                    <option selected disabled>-- Select Role Name --</option>
                                    @foreach ($roles as $name)
                                        <option value="{{ $name->role_type }}">{{ $name->role_type }}</option>
                                    @endforeach
                                </select>
                                @error('role_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nhập mật khẩu">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>Nhập lại mật khẩu</strong></label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">Đăng ký</button>
                            </div>
                            <div class="account-footer">
                                <p>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></p>
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
