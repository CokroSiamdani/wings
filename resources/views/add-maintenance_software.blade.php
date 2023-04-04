@extends('layouts.master')

@section('page-title')
    Add Maintenance software
@endsection

@section('page-heading')
    <span class="badge badge-primary">Maintenance software</span> -
    <small>Add new Maintenance software to database</small>
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
        <form action="{{ route('maintenance_software.save-maintenance_software') }}" method="POST" enctype="multipart/form-data">
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
                        <label for="client" class="col-md-4 col-form-label text-md-left">client</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="client" id="client">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cloud" class="col-md-4 col-form-label text-md-left">cloud</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cloud" id="cloud">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vm_name" class="col-md-4 col-form-label text-md-left">vm_name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="vm_name" id="vm_name">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-left">status</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="status" id="status">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="restarted" class="col-md-4 col-form-label text-md-left">restarted</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="restarted" id="restarted">
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