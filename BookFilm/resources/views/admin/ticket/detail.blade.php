@extends('admin.layouts._layout')

@section('title', 'Chi tiết vé')


@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chi tiết vé đặt trước</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>Khách hàng: <strong>{{ $ticket->Fullname }}</strong></p>
                        <p>Tên phim: <strong>{{ $ticket->Name }}</strong></p>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Số ghế</th>
                                        <th>Bắp & nước</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>{{ $ticket->Sit }}</td>
                                            <td>
                                                @foreach($food_drink as $item)
                                                    {{ $item->Name }} x {{ $item->Quantity }} , 
                                                @endforeach
                                            </td>
                                            <td>{{ number_format($ticket->TotalPrice) }} ₫</td>
                                        </tr>
                                </tbody>
                            </table>
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
           
        });
    </script>
@endsection