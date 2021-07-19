@extends('admin.layouts._layout')

@section('title', 'Update information')


@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">Administrator</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                @if (Session::get('error') != null)
                    <div class="alert alert-success text-center">
                        {{ Session::get('error') }}
                    </div>
                @endif
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            Update admin information

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8">
                                    <form action="/Admin/upatePost" method="Post" enctype="multipart/form-data"
                                        id="frmadd">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{ $admin->ID }}" name="ID">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>Fullname</label>


                                                <input type="text" placeholder="Please enter your fullname"
                                                    value="{{ $admin->Fullname }}" name="Fullname" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>Address</label>


                                                <input type="text" placeholder="Please enter your address"
                                                    value="{{ $admin->Address }}" name="Address" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>Phone number</label>


                                                <input type="text" placeholder="Please enter your phone"
                                                    value="{{ $admin->Phone }}" name="Phone" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>Birthday</label>


                                                <input type="date" placeholder="Please enter your birthday" name="BirthDay"
                                                    id="BirthDay" class="form-control">
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
        $(document).ready(function() {
            /*  //nếu không có thao tác gì thì ẩn đi
             $('#AlertBox').removeClass('hide');

             //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
             $('#AlertBox').delay(2000).slideUp(500); */

            document.getElementById("BirthDay").value =
                '{{ Carbon\Carbon::parse($admin->BirthDay)->format('Y-m-d') }}';

            jQuery.validator.addMethod("phonenu", function(value, element) {
                if (/^(09[0-9]|07[0|6|7|8|9]|03[2-9]|08[1-5])+([0-9]{7})\b/g.test(value)) {
                    return true;
                } else {
                    return false;
                };
            }, "Invalid phone number");


            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmadd").validate({
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
                    Fullname: "Please enter your fullname",
                    Account: "Please enter your account",
                    Password: "Please enter your password",
                    Address: "Please enter your address",
                    BirthDay: "Please enter your birthday",
                    Phone: {
                        required: "Please enter your phone",
                        phonenu: "Your phone is invalid"
                    }
                }
            });
        });
    </script>

@endsection
