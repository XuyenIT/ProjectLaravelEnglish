@extends('admin.layouts._layout')

@section('title', 'Phim sắp chiếu')


@section('content')
<div style="display: none;">{{ $dem = 1 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Phim sắp chiếu</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            @if (Session::get('message') != null)
                <div class="alert alert-success text-center" id="AlertBox">
                    {{ Session::get('message') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4" style="margin-bottom: 10px">
                <a href="/Admin/Film/Add" class="btn btn-lg btn-primary">Thêm mới phim</a>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Phim sắp chiếu
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="width: 20%">Tên phim</th>
                                        <th>Hình ảnh</th>
                                        <th class="text-center" style="width: 30%">Thông tin phim</th>
                                        <th class="text-center" style="width: 15%;">Thể loại phim</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $item)
                                        <tr>
                                            <td>{{ $dem }}</td>
                                            <td>{{ $item->Name }}</td>
                                            <td><img src="{{ asset('assets/images/film/'. $item->Image) }}" alt="" width="110px" /></td>
                                            <td>
                                                <p>Đạo diễn: <strong>{{ $item->Director }}</strong></p>
                                                <p>Diễn viên: <strong>{{ $item->Actor }}</strong></p>
                                                <p>Thời lượng: <strong>{{ $item->Time }}</strong></p>
                                                <p>Ngày phát hành: <strong>{{ Carbon\Carbon::parse($item->ReleaseDate)->format('d/m/Y') }}</strong></p>
                                                <p>Quốc gia: <strong>{{ $item->Country }}</strong></p>
                                            </td>
                                            <td>
                                                @foreach($cate as $jtem)
                                                    @if($jtem->Film_ID == $item->ID)
                                                        {{ $jtem->Name }} |
                                                    @endif
                                                @endforeach
                                            </td>
                                            @if ($item->Status != true)
                                                 <td>
                                                    <button class="btn btn-primary btnStatus" data-id="{{ $item->ID }}" title="Unactive phim">Active</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button class="btn btn-info btnStatus" data-id="{{ $item->ID }}" title="Active phim">Unactive</button>
                                                </td>
                                            @endif
                                            <td>
                                                <button class="btn btn-info btnUpdate" data-id="{{ $item->ID }}" title="Cập nhật thể loại phim"><i class="fa fa-file-video-o"></i></button>
                                                <a href="/Admin/Film/Edit/{{ $item->ID }}" class="btn btn-default" title="Sửa phim"><i class="fa fa-edit"></i></a>
                                                <button class="btn btn-danger btnDelete" data-id="{{ $item->ID }}" title="Xóa phim"><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                        <div style="display: none;">{{ $dem++ }}</div>
                                    @endforeach    

                                </tbody>
                            </table>
                            Trang {{ $query->currentPage() }} / {{ $query->lastPage() }}
                    		{{ $query->links() }}
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>

        </div>

    </div>
    <!-- /.container-fluid -->
</div>

<!-- Modal -->
<div class="modal fade editForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật thể loại phim: <strong id="FilmName"></strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" enctype = "multipart/form-data" method="Post">
                    {{ csrf_field() }}
                    <input type="hidden" name="Film_ID" id="Film_ID" >
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Chọn thể loại phim:</label>
                        <select name="Category_ID" id="Category_ID" class="form-control">
                            <option value="">---Chọn thể loại phim---</option>
                            @foreach($category as $item)
                                <option value="{{ $item->ID }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="CategoryFilm">
                        {{-- <span class="label label-warning" style="font-size: 18px">Hài <i class="fa fa-remove"></i></span>
                        <span class="label label-warning">Chính kịch<i class="fa fa-remove"></i></span> --}}
                        
                    </div>

                    {{-- <div class="form-group">
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </div> --}}
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>



@endsection


@section('jsAdmin'){

    <script type="text/javascript">
        $(function () {
            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);


            $('.btnDelete').off('click').on('click', function () {
                const notice = PNotify.notice({
                    title: 'Thông báo',
                    text: 'Bạn thật sự muốn xóa?',
                    icon: 'fa fa-question-circle',
                    width: '360px',
                    minHeight: '110px',
                    hide: false,
                    closer: false,
                    sticker: false,
                    destroy: true,
                    stack: new PNotify.Stack({
                        dir1: 'down',
                        modal: true,
                        firstpos1: 25,
                        overlayClose: false
                    }),
                    modules: new Map([
                        ...PNotify.defaultModules,
                        [PNotifyConfirm, {
                            confirm: true
                        }]
                    ])
                });

                notice.on('pnotify:confirm', () =>
                    $.ajax({
                        data: {},
                        url: '/Admin/Film/Delete/' + $(this).data('id'),
                        dataType: 'Json',
                        type: 'GET',
                        success: function () {
                                window.location.href = "/Admin/Film/ComingMovie";
                                PNotify.success({
                                    title: 'THÔNG BÁO!!',
                                    text: 'Xóa phim thành công.'
                                });
                           
                        }
                    })

                );


            });

            $('.btnUpdate').click(function(event) {
                $('.editForm').modal('show');
                //alert($(this).data('id'));
                var ID = $(this).data('id');
                $('#Film_ID').val(ID);
                $.ajax({
                        url: "/Admin/Film/GetCategoryFilmByID/" + ID,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {
                            $('#CategoryFilm').empty();
                            html = "";
                            $.each(res.cate, function (i, item) {
                                html += '<span class="label label-warning labelCate" >'+ item.Name +
                                            '<a href="javascript:void(0)" class="btnDel" data-id="'+ item.ID +'">'+
                                                '<i class="fa fa-remove fa_icon" title="xóa"></i>'+
                                            '</a>'+
                                        '</span>';

                                $('option[value="'+ item.Category_ID +'"]').remove();
                                console.log(item.Name);
                            });
                            $('#FilmName').text(res.film.Name);
                            $('#CategoryFilm').append(html);
                        }
                    });
            });

            $('#CategoryFilm').on('click', '.btnDel', function(event) {
                var ID = $(this).data('id');
                $(this).closest('span').remove();
                $.ajax({
                        url: "/Admin/Film/DeleteCate/" + ID,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {
                            $('#Category_ID').append('<option value="'+ res.cate.ID +'">'+ res.cate.Name +'</option>')
                        }
                    });
            });

            $('#Category_ID').change(function(event) {
                
                var Film_ID = $('#Film_ID').val();
                var Category_ID = $(this).val();
                $.ajax({
                        url: "/Admin/Film/AddCate/" + Film_ID + "/" + Category_ID,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        success: function (res) {
                            html = '<span class="label label-warning labelCate">'+ res.cate.Name +
                                        '<a href="javascript:void(0)" class="btnDel" data-id="'+ res.cate.ID +'">'+
                                            '<i class="fa fa-remove fa_icon" title="xóa"></i>'+
                                        '</a>'+
                                    '</span>'
                            $('#CategoryFilm').append(html);

                            $('option[value="'+ Category_ID +'"]').remove();
                        }
                    });
            });

            $(".editForm").on("hidden.bs.modal", function () {
                window.location.href = "/Admin/Film/ComingMovie";
            });

            $('.btnStatus').off('click').on('click', function () {

                $.ajax({
                    data: {},
                    url: '/Admin/Film/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/Admin/Film/ComingMovie";
                            PNotify.success({
                                title: 'THÔNG BÁO!!',
                                text: 'Cập nhật trạng thái thành công.'
                            });
                    }
                });

            });
        });
        
    </script>
@endsection