@extends('admin.layouts._layout')

@section('title', 'Sửa phim')


@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sửa thông tin phim</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Sửa thông tin phim
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <form action="/Admin/Film/EditFilm" method="Post" enctype="multipart/form-data" id="frmadd">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $film->ID }}" name="ID">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tên phim</label>
                                            <input type="text" name="Name" value="{{ $film->Name }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Đạo diễn</label>
                                            <input type="text" name="Director" value="{{ $film->Director }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diễn viên</label>
                                            <input type="text" name="Actor" value="{{ $film->Actor }}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Thời lượng</label>
                                            <input type="text" value="{{ $film->Time }}"  name="Time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ngày phát hành</label>
                                            <input type="date" name="ReleaseDate" id="ReleaseDate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quốc gia</label>
                                            <input type="text"  name="Country" value="{{ $film->Country }}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Độ tuổi phù hợp</label>
                                            <input type="number" min="5" value="{{ $film->AgeRestriction }}"  name="AgeRestriction" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hình ảnh phim</label>
                                            <label for="file-upload" class="custom-file-upload">
                                                <i class="fa fa-cloud-upload"></i> {{ $film->Image }}
                                            </label>
                                            <input id="file-upload" name="Image" type="file" style="display:none;" accept="image/*">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Link trailer (Link Youtube)</label>
                                            <input type="text"  name="Trailer" value="{{ $film->Trailer }}"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea name="Description" id="Description" class="form-control" rows="3" placeholder="Nhập mô tả sản phẩm, tối thiểu 200 ký tự">{{ $film->Description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <button type="reset" class="btn btn-default">Đặt lại</button>
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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
            document.getElementById("ReleaseDate").value = '{{ Carbon\Carbon::parse($film->ReleaseDate)->format('Y-m-d') }}';

            $('#file-upload').change(function() {
              var i = $(this).prev('label').clone();
              var file = '<i class="fa fa-cloud-upload"></i>' + $('#file-upload')[0].files[0].name;
              $(this).prev('label').empty();
              $(this).prev('label').append(file);
            });
            // CKEDITOR.replace('Descriptions');
            
            // add the rule here
            $.validator.addMethod("select_validate", function (value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");
            //Khi bàn phím được nhấn và thả ra thì sẽ chạy phương thức này
            $("#frmadd").validate({
                rules: {
                    Name: "required",
                    Director: "required",
                    Actor: "required",
                    Time: "required",
                    Descriptions: {
                        required: true,
                        minlength: 200
                    },
                    Image: "required",
                    ReleaseDate: "required",
                    AgeRestriction: "required",
                    Trailer: "required",
                    Country: "required"
                },
                messages: {
                    Name: "Vui lòng nhập tên phim",
                    Director: "Vui lòng nhập đạo diễn phim",
                    Actor: "Vui lòng nhập các diễn viên trong phim",
                    Time: "Vui lòng nhập thời lượng phim",
                    Descriptions: {
                        required: "Vui lòng nhập mô tả",
                        minlength: "Mô tả quá ngắn, tối thiểu 200 ký tự"
                    },
                    Image: "Bạn chưa chọn ảnh phim",
                    ReleaseDate: "Vui lòng nhập ngày phát hành phim",
                    AgeRestriction: "Vui lòng nhập độ tuổi phù hợp xem phim",
                    Trailer: "Vui lòng nhập trailer phim",
                    Country: "Vui lòng nhập quốc gia của phim"
                }
            });
        });
    </script>

@endsection