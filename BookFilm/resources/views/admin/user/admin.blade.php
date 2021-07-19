@extends('admin.layouts._layout')

@section('title', 'Quản lý người dùng')


@section('content')
    <div style="display: none;">{{ $dem = 1 }}</div>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Admin's account</h1>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-md-4" style="margin-bottom: 10px">
                    <a href="/Admin/registerAdmin" class="btn btn-lg btn-primary">Add</a>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Admin registered in the system
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="displayTables">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Account</th>
                                            <th>Fullname</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Gender</th>
                                            <th>Birthday</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($query as $item)
                                            <tr>
                                                <td>{{ $dem }}</td>
                                                <td>{{ $item->Account }}</td>
                                                <td>
                                                    {{ $item->Fullname }}
                                                </td>
                                                <td>  {{ $item->Email }}</td>
                                                <td>{{ $item->Address }}</td>
                                                <td>{{ $item->Phone }}</td>
                                                <td>{{ $item->Sex }}</td>
                                                <td>{{ Carbon\Carbon::parse($item->BirthDay)->format('d/m/Y') }}</td>
                                                <td>
                                                    @if ($item->Status != true)
                                                        <button class="btn btn-secondary btnStatus"
                                                            data-id="{{ $item->ID }}"
                                                            title="Khóa tài khoản">Locked</button>
                                                    @else
                                                        <button class="btn btn-info btnStatus"
                                                            data-id="{{ $item->ID }}"
                                                            title="Kích hoạt tài khoản">Unlocked</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="/Admin/User/Delete/{{ $item->ID }}"
                                                        class="btn btn-danger btnDelete"> <i class="fa fa-remove"></i></a>
                                                </td>

                                            </tr>
                                            <div style="display: none;">{{ $dem++ }}</div>
                                        @endforeach

                                    </tbody>
                                </table>
                                Page {{ $query->currentPage() }} / {{ $query->lastPage() }}
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
        $(function() {
            //nếu không có thao tác gì thì ẩn đi
            $('#AlertBox').removeClass('hide');

            //Sau khi hiển thị lên thì delay 1s và cuộn lên trên sử dụng slideup
            $('#AlertBox').delay(2000).slideUp(500);



            $('.btnStatus').off('click').on('click', function() {

                $.ajax({
                    data: {},
                    url: '/Admin/User/changeStatus/' + $(this).data('id'),
                    dataType: 'Json',
                    type: 'GET',
                    success: function() {
                        window.location.href = "/Admin/User/indexAdmin";
                        PNotify.success({
                            title: 'Messages!!',
                            text: 'Status update successful.'
                        });
                    }
                });

            });

            $('.btnDelete').on('click', function(event) {
                event.preventDefault();
                const url = $(this).attr('href');
                swal({
                    title: 'Are you sure?',
                    text: 'This record and it`s details will be permanantly deleted!',
                    icon: 'warning',
                    buttons: ["Cancel", "Yes!"],
                }).then(function(value) {
                    if (value) {
                        window.location.href = url;
                    }
                });
            });

         /*    $('#displayTables').DataTable(); */
        });
    </script>
@endsection
