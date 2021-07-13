@extends('admin.layouts._layout')

@section('title', 'Quản lý người dùng')


@section('content')
<div style="display: none;">{{ $dem = 1 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Quản lý người dùng</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Người dùng đã đăng ký trong hệ thống
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tài khoản</th>
                                        <th>Thông tin chung</th>
                                        <th>Điểm thưởng</th>
                                        <th>Thành viên</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($query as $item)
                                        <tr>
                                            <td>{{ $dem }}</td>
                                            <td>{{ $item->Account }}</td>
                                            <td>
                                                <p>Họ tên: <strong>{{ $item->Fullname }}</strong></p>
                                                <p>Địa chỉ: <strong>{{ $item->Address }}</strong></p>
                                                <p>Điện thoại: <strong>{{ $item->Phone }}</strong></p>
                                                <p>Giới tính: <strong>{{ $item->Sex }}</strong></p>
                                                <p>Ngày sinh: <strong>{{ Carbon\Carbon::parse($item->BirthDay)->format('d/m/Y') }}</strong></p>
                                            </td>
                                            @if(count($member) > 0)
                                                @foreach($member as $jtem)
                                                    @if($jtem->User_ID == $item->ID)
                                                         <td>{{ $jtem->Point }}</td>
                                                         <td>{{ $jtem->Name }}</td>
                                                    @endif
                                                @endforeach
                                            @else
                                                <td>Chưa cập nhật</td>
                                                <td>Chưa cập nhật</td>
                                            @endif
                                            
                                           
                                            @if ($item->Status != true)
                                                 <td>
                                                    <button class="btn btn-secondary btnStatus" data-id="{{ $item->ID }}" title="Khóa tài khoản">Đã khóa</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button class="btn btn-info btnStatus" data-id="{{ $item->ID }}" title="Kích hoạt tài khoản">Đang hoạt động</button>
                                                </td>
                                            @endif
                                           
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


@endsection


@section('jsAdmin'){

    <script type="text/javascript">
        $(function () {
            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);


           
            $('.btnStatus').off('click').on('click', function () {

                $.ajax({
                    data: {},
                    url: '/Admin/User/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function () {
                            window.location.href = "/Admin/User";
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