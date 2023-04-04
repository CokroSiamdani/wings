@extends('layouts.master')

@section('page-title')
    Add Assignment - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Assignment</span> -
    <small>Add new assignment to database</small>
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
        <form action="{{ route('product_staff.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="nama_staff" class="col-md-4 col-form-label text-md-left">Nama Staff</label>
                        <div class="col-md-8">
                            <select name="nama_staff" id="nama_staff" class="form-control" required>
                                <option value="">-- Select --</option>
                                @foreach($staffs as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->nama_staff }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label text-md-left">Nama Product</label>
                        <div class="col-md-8">
                            <select name="product_name" id="product_name" class="form-control" required>
                                <option value="">-- Select --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
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