@extends('layouts.app')
@section('content')
    <div class="main-wrapper">
        <div class="account-content">
           
            <div class="container">
              
                <!-- /Account Logo -->
                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Đăng nhập</h3>
                        <!-- Account Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Mật khẩu </label>
                                    </div>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label></label>
                                    </div>
                                    <div class="col-auto">
                                        <a class="text-muted" href="{{ route('forget-password') }}">
                                            Quên mật khẩu?
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">Đăng nhập</button>
                            </div>
                            <div class="account-footer">
                                <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></p>
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
