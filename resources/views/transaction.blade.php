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
    Transaction - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Transaction</span> -
    <small>Manage Transaction</small>
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
            <h6 class="m-0 font-weight-bold text-primary">Manage Transaction</h6>
            <a href="{{ route('transaction.add') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                      <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Add New Transaction</span>
            </a>
        </div>

        <!--Transaction Modal-->

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="add-category"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5 id="exampleModalLabel"><span class="badge badge-primary">Transaction Details</span></h5><small>Particular transaction information</small>
                        </div>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered transaction-table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Transaction Date</th>
                                        <th>Total Item</th>
                                        <th>Purchase Note</th>
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
                        <th>Transaction Date</th>
                        <th>Total Item</th>
                        <th>Purchase Note</th>
                        <th>Action</th>
                        <th>Qr Code</th>
                    </tr>
                    </thead>
                    {{-- <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Transaction Date</th>
                        <th>Total Item</th>
                        <th>Purchase Note</th>
                        <th>Action</th>
                        <th>Qr Code</th>
                    </tr>
                    </tfoot> --}}
                    <tbody>
                    @foreach($transactions as $transaction)
                        {{ QrCode::size(500)->format('png')->generate('Transaction ID : ' . $transaction->id, storage_path('app/public/qr_codes/' . $transaction->id . '.png')) }}
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->transaction_date }}</td>
                            <td>{{ $transaction->total_item }}</td>
                            <td>{{ $transaction->purchase_note }}</td>
                            {{-- <td>{{ QrCode::size(100)->generate($transaction->id . '/' . $transaction->transaction_date . '/' . $transaction->total_item . '/' . $transaction->purchase_note, storage_path('app/public/qr_codes' . $transaction->id . '.png')) }}</td> --}}
                            <td>
                                <a href="#" class="btn btn-info btn-icon-split btn-sm mr-2" data-toggle="modal" data-target="#modal" onclick="getTransactions({{ $transaction->id }})">
                                    <span class="icon">
                                      <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="text">View</span>
                                </a>
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('transaction.download-qr-code', $transaction->id) }}" class="btn btn-info btn-icon-split btn-sm mr-2">
                                    <span class="icon">
                                      <i class="fa fa-download"></i>
                                    </span>
                                    <span class="text">Download</span>
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
        function getTransactions(id) {
            $.get('transaction/view/' + id)
                .done(function (data) {
                    var html = '';
                    data.forEach(function (transaction) {
                        html += '<tr>'
                        html += '<td>' + transaction.transaction_date + '</td>'
                        html += '<td>' + transaction.total_item + '</td>'
                        html += '<td>' + transaction.purchase_note + '</td>'
                        html += '<td>'
                        html += '<a href="transaction/edit/'+ transaction.id +'" class="btn btn-warning btn-circle btn-sm mr-2 btnEdit" ><i class="fas fa-edit"></i></a>'
                        html += '<a href="transaction/delete/'+ transaction.id +'" class="btn btn-danger btn-circle btn-sm mr-2 btnEdit" onclick="if(!confirm('+'Are you sure to delete?'+')) return false"><i class="fas fa-trash"></i></a>'
                        html += '</td> </tr>';
                    })
                    $('.transaction-table tbody').html(html)
                })
        }
    </script>
@endsection