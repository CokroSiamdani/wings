@extends('layouts.master')

@section('page-title')
    Edit Maintenance software
@endsection

@section('page-heading')
    <span class="badge badge-primary">Maintenance software</span> -
    <small>Edit Maintenance software</small>
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
        <form action="{{ route('maintenance_software.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="id" class="col-md-4 col-form-label text-md-left">Maintenances_software ID</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="id" id="id"
                                   value="{{ $maintenances_software->id }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maintenance_date" class="col-md-4 col-form-label text-md-left">maintenance_date</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="maintenance_date" id="maintenance_date"
                                   value="{{ $maintenances_software->maintenance_date }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="client" class="col-md-4 col-form-label text-md-left">client</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="client" id="client" value="{{ $maintenances_software->client }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cloud" class="col-md-4 col-form-label text-md-left">cloud</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="cloud" id="cloud" value="{{ $maintenances_software->cloud }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vm_name" class="col-md-4 col-form-label text-md-left">vm_name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="vm_name" id="vm_name" value="{{ $maintenances_software->vm_name }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="status" class="col-md-4 col-form-label text-md-left">status</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="status" id="status"
                                   value="{{ $maintenances_software->status }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="restarted" class="col-md-4 col-form-label text-md-left">restarted</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="restarted" id="restarted" value="{{ $maintenances_software->restarted }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-left">description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="description" id="description" value="{{ $maintenances_software->description }}" required>
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