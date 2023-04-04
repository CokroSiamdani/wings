@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/datatables/dataTables.bootstrap4.min.css">
    <style>
        .modal-dialog {
            max-width: 997px;
        }
    </style>
@endsection

@section('page-title')
    Assignment - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Assignment</span> -
    <small>Manage Assignment</small>
@endsection

@section('main-content')
    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert_type') }} alert-dismissible fade show" data-auto-dismiss>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ Session::get('message') }}.
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Manage Assignment</h6>
            <a href="{{ route('product_staff.add') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                      <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Add New Assignment</span>
            </a>
        </div>

        <!--Transaction Modal-->

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="add-category"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5 id="exampleModalLabel"><span class="badge badge-primary">Assignment Details</span></h5><small>Particular assignment information</small>
                        </div>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered product_staff-table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Nama Staff</th>
                                        <th>Nama Produk</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--/End Stock Modal-->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Staff</th>
                        <th>Nama Produk</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nama Staff</th>
                        <th>Nama Produk</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($product_staffs as $product_staff)
                        <tr>
                            <td>{{ $product_staff->id }}</td>
                            <td>{{ $product_staff->staff->nama_staff }}</td>
                            <td>{{ $product_staff->product->product_name }}</td>
                            <td class="d-flex">
                                <a href="#" class="btn btn-info btn-icon-split btn-sm mr-2" data-toggle="modal" data-target="#modal" onclick="getProductStaff({{ $product_staff->id }})">
                                    <span class="icon">
                                      <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="text">View</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('admin') }}/js/demo/datatables-demo.js"></script>

    <script>
        function getProductStaff(id) {
            $.get('product_staff/view/' + id)
                .done(function (data) {
                    // console.log(data);
                    var html = '';
                    html += '<tr>'
                    html += '<td>' + data[1] + '</td>'
                    html += '<td>' + data[2] + '</td>'
                    html += '<td>'
                    html += '<a href="product_staff/edit/'+ data[0] +'" class="btn btn-warning btn-circle btn-sm mr-2 btnEdit" ><i class="fas fa-edit"></i></a>'
                    html += '<a href="product_staff/delete/'+ data[0] +'" class="btn btn-danger btn-circle btn-sm mr-2 btnEdit" onclick="if(!confirm('+'Are you sure to delete?'+')) return false"><i class="fas fa-trash"></i></a>'
                    html += '</td> </tr>';
                    $('.product_staff-table tbody').html(html)
                })
        }
    </script>
@endsection