@extends('layouts.master')

@section('page-title')
    Add maintenance_pc_laptop
@endsection

@section('page-heading')
    <span class="badge badge-primary">maintenance_pc_laptop</span> -
    <small>Add new maintenance_pc_laptop to database</small>
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
        <form action="{{ route('maintenance_pc_laptop.save-maintenance_pc_laptop') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="maintenance_date" class="col-md-4 col-form-label text-md-left">Maintenance date</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="maintenance_date" id="maintenance_date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-left">category</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="category" id="category">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="item_name" class="col-md-4 col-form-label text-md-left">item_name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="item_name" id="item_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-md-4 col-form-label text-md-left">brand</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="brand" id="brand">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="serial_number" class="col-md-4 col-form-label text-md-left">serial_number</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="serial_number" id="serial_number">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="user_name" class="col-md-4 col-form-label text-md-left">user_name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="user_name" id="user_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-left">status</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="status" id="status">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_8_chars" class="col-md-4 col-form-label text-md-left">password_8_chars</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="password_8_chars" id="password_8_chars">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_combination" class="col-md-4 col-form-label text-md-left">password_combination</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="password_combination" id="password_combination">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-left">description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="description" id="description">
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