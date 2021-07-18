@extends('admin.layouts._layout')

@section('title', 'Thống kê, báo cáo')


@section('content')
<div style="display: none;">{{ $dem_1 = 0, $dem_2 = 0 }}</div>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thống kê & báo cáo</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $count_user }}</div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right text-panel">Thành viên website!</span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="fa fa-money fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ number_format($count_money) }}đ</div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right text-panel">Doanh thu!</span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-2">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $count_ticket }}</div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left"></span>
                            <span class="pull-right text-panel">Pre-order tickets!</span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>Xếp hạng phim
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên phim</th>
                                        <th>Thể loại</th>
                                        <th>Điểm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstFilm as $item)
                                    	<div style="display: none;">{{ $dem_1++ }}</div>
                                        <tr>
                                            <td>{{ $dem_1 }}</td>
                                            <td>{{ $item->Name }}</td>
                                            <td>
                                                @foreach($cate as $jtem)
                                                    @if($jtem->Film_ID == $item->ID)
                                                        {{ $jtem->Name }} ,
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $item->Vote }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i>Phim đặt vé nhiều
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Tên phim</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($film_ticket as $item)
                                    	<div style="display: none;">{{ $dem_2++ }}</div>
                                        <tr>
                                            <td>{{ $dem_2 }}</td>
                                            <td>{{ $item->Name }}</td>
                                            <td>{{ $item->count_film }}</td>
                                        </tr>

                                    @endforeach
                                        {{-- {{ var_dump($listProduct_sell) }} --}}

                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                </div>
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> Báo cáo hàng ngày
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <i class="fa fa-comment fa-fw"></i> Đánh giá phim mới
                                <span class="pull-right text-muted small">
                                    <em>{{ $comment_today}} đánh giá</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-address-book-o fa-fw"></i> Vé đặt hôm nay
                                <span class="pull-right text-muted small">
                                    <em>{{ $ticket_today}} vé</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-user fa-fw"></i> User đã đăng ký
                                <span class="pull-right text-muted small">
                                    <em>{{ $count_user }} user</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-users fa-fw"></i> Phim đang chiếu
                                <span class="pull-right text-muted small">
                                    <em>{{ $moviePlay }} phim</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-inbox fa-fw"></i> Phim sắp chiếu
                                <span class="pull-right text-muted small">
                                    <em>{{ $comingMovie }} phim</em>
                                </span>
                            </a>

                        </div>
                        <!-- /.list-group -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

@endsection