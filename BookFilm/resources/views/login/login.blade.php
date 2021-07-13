@extends('layouts._layout')

@section('title', 'Đăng nhập')

@section('content')

<form id="login-form" action="/login" method="post">
    {{ csrf_field() }}
    <div class="login">
        <p class="login__title">Đăng nhập<br><span class="login-edition">Chào mừng tới với A.Movie</span></p>
        @if(Session::get('error') != null)
        <div class="alert alert-danger text-center">
            {{ Session::get('error') }}
        </div>
        @endif

        <div class="field-wrap">
            <input type="text" placeholder="Nhập tài khoản" name="Account" class="login__input" required>
            <input type="password" placeholder="Nhập mật khẩu" name="Password" class="login__input" required>

        </div>

        <div class="login__control">
            <button type="submit" class="btn btn-md btn--warning btn--wider">Đăng nhập</button>
            <a href="#" class="login__tracker form__tracker">Quên mật khẩu?</a>
        </div>
    </div>
</form>

@endsection