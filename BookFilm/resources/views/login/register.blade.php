@extends('layouts._layout')

@section('title', 'Đăng ký tài khoản')

@section('content')

<form action="/register"  method="Post" id="login-form"  class="">
    {{ csrf_field() }}
    <div class="login">
        <p class="login__title">Đăng ký tài khoản<br><span class="login-edition">Chào mừng tới A.Movie</span></p>
        @if(Session::get('error') != null)
        <div class="alert alert-danger text-center">
            {{ Session::get('error') }}
        </div>
        @endif
        <div class="field-wrap">
            <input type="text" placeholder="Nhập họ và tên" name="Fullname" class="login__input">
            <input type="text" placeholder="Nhập tài khoản" name="Account" class="login__input" >
            <input type="password" placeholder="Nhập mật khẩu" name="Password" class="login__input">
            <input type="text" placeholder="Nhập địa chỉ" name="Address" class="login__input" >
            <input type="text" placeholder="Nhập số điện thoại" name="Phone" class="login__input" >

            <div class="col-sm-4">
                <label style="margin-top: 3px;">Ngày sinh</label>
            </div>
            <input type="date" placeholder="Nhập ngày tháng năm sinh" name="BirthDay" class="login__input" >

            <div class="col-sm-4">
                <label style="margin-top: 3px;">Giới tính</label>
            </div>
            <div class="col-sm-4">
                <label style="margin-top: 3px;">Nam</label>
                <input type="radio" value="Nam" name="Sex" checked>
            </div>
            <div class="col-sm-4">
                <label style="margin-top: 3px;">Nữ</label>
                <input type="radio" value="Nữ" name="Sex">
            </div>
        </div>

        <div class="login__control" style="margin-top: 40px">
            <input type="submit" value="Đăng ký" class="btn btn-md btn--warning btn--wider">
            <a href="/dang-nhap.html" class="login__tracker form__tracker">Đã có tài khoản?</a>
        </div>
    </div>
</form>

@endsection

@section('jsSection')

<script>
    $(document).ready(function () {
        jQuery.validator.addMethod("phonenu", function (value, element) {
            if (/^(09[0-9]|07[0|6|7|8|9]|03[2-9]|08[1-5])+([0-9]{7})\b/g.test(value)) {
                return true;
            } else {
                return false;
            };
        }, "Invalid phone number");

        
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#login-form").validate({
                rules: {
                    Fullname: "required",
                    Account: "required",
                    Password: "required",
                    Address: "required",
                    BirthDay: "required",
                    Phone: {
                        required: true,
                        phonenu: true
                    }
                },
                messages: {
                    Fullname: "Vui lòng nhập họ và tên",
                    Account: "Vui lòng nhập tài khoản",
                    Password: "Vui lòng nhập mật khẩu",
                    Address: "Vui lòng nhập địa chỉ",
                    BirthDay: "Vui lòng nhập ngày tháng năm sinh",
                    Phone: {
                        required: "Vui lòng nhập số điện thoại",
                        phonenu: "Số điện thoại không hợp lệ"
                    }
                }
            });
        });
    </script>


@endsection