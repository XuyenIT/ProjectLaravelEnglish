@extends('layouts._layout')

@section('title', 'Đổi mật khẩu')

@section('content')

<form action="/changepass"  method="Post" id="login-form"  class="">
    {{ csrf_field() }}
    <div class="login">
        <p class="login__title">Đổi mật khẩu<br><span class="login-edition">Chào mừng tới A.Movie</span></p>
        
        @if(Session::get('error') != null)
        <div class="alert alert-danger text-center">
            {{ Session::get('error') }}
        </div>
        @endif

        <div class="field-wrap">
            <input type="password" placeholder="Nhập mật khẩu cũ" name="OldPass" class="login__input">
            <input type="password" placeholder="Nhập mật khẩu mới" name="NewPass" id="NewPass" class="login__input" >
            <input type="password" placeholder="Nhập lại mật khẩu" name="RePass" class="login__input">
        </div>

        <div class="login__control" style="margin-top: 40px">
            <input type="submit" value="Đổi mật khẩu" class="btn btn-md btn--warning btn--wider">
            <a href="/dang-nhap.html" class="login__tracker form__tracker">Đăng nhập</a>
        </div>
    </div>
</form>

@endsection

@section('jsSection')

<script>
    $(document).ready(function () {
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#login-form").validate({
                rules: {
                    NewPass: "required",
                    OldPass: "required",
                    RePass: {
                        required: true,
                        equalTo: "#NewPass"
                    }
                },
                messages: {
                    NewPass: "Vui lòng nhập mật khẩu mới",
                    OldPass: "Vui lòng nhập mật khẩu cũ",
                    RePass: {
                        required: "Vui lòng nhập lại mật khẩu",
                        equalTo: "Nhập lại mật khẩu không khớp"
                    }
                }
            });
        });
    </script>


@endsection