@extends('layouts.master')

@section('page-title')
    Edit Assignment - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Assignment</span> -
    <small>Edit assignment of product</small>
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
        <form action="{{ url('product_staff/update/' . $product_staffs->id) }}" method="POST">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="assignment_id" class="col-md-4 col-form-label text-md-left">Assignment ID</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="assignment_id" id="assignment_id"
                                   value="{{ $product_staffs->id }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_staff" class="col-md-4 col-form-label text-md-left">Nama Staff</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nama_staff" id="nama_staff"
                                   value="{{ $staffs->nama_staff }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group row">
                        <label for="product_id" class="col-md-4 col-form-label text-md-left">Product Name</label>
                        <div class="col-md-8">
                            <select name="product_id" id="product_id" class="form-control" required>
                                <option value="">-- Select --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ ($product_staffs->product_id == $product->id) ? 'selected = "selected"' : '' }}>{{ $product->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row float-right">
                        <input type="submit" class="btn btn-primary mr-3" value="Update">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection