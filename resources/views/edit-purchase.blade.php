@extends('layouts.master')

@section('page-title')
    Edit Stock - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Stock</span> -
    <small>Edit product of stock</small>
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
        <form action="{{ route('stock.update') }}" method="POST">
            @csrf
            {{-- <input type="hidden" name="old_quantity" value="{{ $products->quantity }}"> --}}
            {{-- <input type="hidden" name="old_price" value="{{ $products->price }}"> --}}
            <div class="row" class="bg-white">
                <div class="col-md-6">
                    {{-- <div class="form-group row">
                        <label for="purchase_id" class="col-md-4 col-form-label text-md-left">Purchase ID</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="purchase_id" id="purchase_id"
                                   value="{{ $products->box_id }}" readonly>
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="id" class="col-md-4 col-form-label text-md-left">ID</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="id" id="id"
                                   value="{{ $products->id }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-left">Category</label>
                        <div class="col-md-8">
                            <select name="category" id="category" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach($categories as $category)
                                    @isset($products->category->id)
                                        <option value="{{ $category->id }}" {{ ($products->category->id == $category->id) ? 'selected="selected"' : '' }}>{{ $category->name }}</option>    
                                    @endisset
                                    @empty($products->category->id)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endempty
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product" class="col-md-4 col-form-label text-md-left">Product</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="product" id="product"
                                   value="{{ $products->product_name }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brand" class="col-md-4 col-form-label text-md-left">Brand</label>
                        <div class="col-md-8">
                            {{-- <select name="brand" id="brand" class="form-control" required>
                                <option value="">-- Select --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ ($products->brand->id == $brand->id) ? 'selected = "selected"' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select> --}}
                            <input type="text" class="form-control" name="brand" id="brand" value="{{ $products->brand }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="specification" class="col-md-4 col-form-label text-md-left">Specification</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="specification" id="specification" value="{{ $products->specification }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="serial_number" class="col-md-4 col-form-label text-md-left">Serial Number</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="serial_number" id="serial_number"
                                   value="{{ $products->serial_number }}">
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-left">Purchased Quantity</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="quantity" id="quantity"
                                   value="{{ $products->quantity }}">
                        </div>
                    </div> --}}
                    {{-- <div class="form-group row">
                        <label for="availableQty" class="col-md-4 col-form-label text-md-left">Available
                            Quantity</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="availableQty" id="availableQty"
                                   value="{{ $products->availableQty }}">
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-left">Per Price</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="price" id="price"
                                   value="{{ $products->price }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="buy_date" class="col-md-4 col-form-label text-md-left">Buy Date</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="buy_date" id="buy_date"
                                   value="{{ $products->buy_date }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="expired_date" class="col-md-4 col-form-label text-md-left">Expired Date</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control" name="expired_date" id="expired_date"
                                   value="{{ $products->expired_date }}">
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