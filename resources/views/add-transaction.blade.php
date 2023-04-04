@extends('layouts.master')

@section('page-title')
    Add Transaction - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Transaction</span> -
    <small>Add new transaction to database</small>
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
    <div class="card card-body">
        <form action="{{ route('transaction.save-transaction') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="transaction_date" class="col-md-4 col-form-label text-md-left">Transaction Date</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="transaction_date" id="transaction_date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_item" class="col-md-4 col-form-label text-md-left">Total Item</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="total_item" id="total_item">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="purchase_note" class="col-md-4 col-form-label text-md-left">Purchase Note</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control" name="purchase_note" id="purchase_note">
                        </div>
                    </div>
                    <div class="form-group row float-right">
                        <input type="submit" class="btn btn-primary mr-3" value="Save">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection