@extends('admin.layouts._layout')

@section('title', 'Đổi mật khẩu')


@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administrator </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            @if (Session::get('error') != null)
                <div class="alert alert-danger text-center" id="AlertBox">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Change Password
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <form action="/Admin/FormChangePass" method="Post" enctype="multipart/form-data" id="frmadd">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Old password</label>
                                            <input type="password" name="OldPass" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>New password</label>
                                            <input type="password" name="NewPass"  id="NewPass" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Enter the password</label>
                                            <input type="password" name="RePass" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default">Reset</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>

                                </form>

                            </div>

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection


@section('jsAdmin')

 <script>
        $(document).ready(function () {
            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);
            
            $("#frmadd").validate({
                rules: {
                    NewPass: "required",
                    OldPass: "required",
                    RePass: {
                        required: true,
                        equalTo: "#NewPass"
                    }
                },
                messages: {
                    NewPass: "Please enter new password",
                    OldPass: "Please enter old password",
                    RePass: {
                        required: "Please enter password",
                        equalTo: "password error"
                    }
                }
            });
        });
    </script>

@endsection