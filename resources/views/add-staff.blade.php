@extends('layouts.master')

@section('page-title')
    Add Staff - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Staff</span> -
    <small>Add new staff to database</small>
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
        <form action="{{ route('staff.save-staff') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="nama_staff" class="col-md-4 col-form-label text-md-left">Nama Staff</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nama_staff" id="nama_staff" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position" class="col-md-4 col-form-label text-md-left">Position</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="position" id="position">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="division" class="col-md-4 col-form-label text-md-left">Division</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="division" id="division">
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