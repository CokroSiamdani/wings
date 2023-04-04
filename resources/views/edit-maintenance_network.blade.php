@extends('layouts.master')

@section('page-title')
    Edit Maintenance network
@endsection

@section('page-heading')
    <span class="badge badge-primary">Maintenance network</span> -
    <small>Edit Maintenance network</small>
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
        <form action="{{ route('maintenance_network.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="id" class="col-md-4 col-form-label text-md-left">Maintenances_network ID</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="id" id="id"
                                   value="{{ $maintenances_network->id }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="maintenance_date" class="col-md-4 col-form-label text-md-left">maintenance_date</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="maintenance_date" id="maintenance_date"
                                   value="{{ $maintenances_network->maintenance_date }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-left">category</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="category" id="category" value="{{ $maintenances_network->category }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-md-4 col-form-label text-md-left">brand</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="brand" id="brand" value="{{ $maintenances_network->brand }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="serial_number" class="col-md-4 col-form-label text-md-left">serial_number</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="serial_number" id="serial_number" value="{{ $maintenances_network->serial_number }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="power" class="col-md-4 col-form-label text-md-left">power</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="power" id="power"
                                   value="{{ $maintenances_network->power }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="connection" class="col-md-4 col-form-label text-md-left">connection</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="connection" id="connection" value="{{ $maintenances_network->connection }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="restarted" class="col-md-4 col-form-label text-md-left">restarted</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="restarted" id="restarted" value="{{ $maintenances_network->restarted }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-left">description</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="description" id="description" value="{{ $maintenances_network->description }}" required>
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