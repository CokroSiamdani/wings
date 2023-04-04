@extends('layouts.master')

@section('page-title')
    Edit Staff - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Staff</span> -
    <small>Edit staff</small>
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
        <form action="{{ route('staff.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="id" class="col-md-4 col-form-label text-md-left">Staff ID</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="id" id="id"
                                   value="{{ $staffs->id }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_staff" class="col-md-4 col-form-label text-md-left">Nama Staff</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nama_staff" id="nama_staff"
                                   value="{{ $staffs->nama_staff }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position" class="col-md-4 col-form-label text-md-left">Position</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="position" id="position" value="{{ $staffs->position }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="division" class="col-md-4 col-form-label text-md-left">Division</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="division" id="division"
                                   value="{{ $staffs->division }}">
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