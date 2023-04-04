@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/vendor/datatables/dataTables.bootstrap4.min.css">
    <style>
        .modal-dialog {
            max-width: 997px;
        }
    </style>
@endsection

@section('page-title')
    Stock - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Stock</span> -
    <small>Manage Stock</small>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Manage Stock</h6>
            <a href="{{ route('stock.add') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                      <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Add new Stock</span>
            </a>
            <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                Import Excel
            </button>
        </div>

        <!--Stock Modal-->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="add-category"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5 id="exampleModalLabel"><span class="badge badge-primary">Stock Details</span></h5><small>Particular product information</small>
                        </div>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered product-table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Price</th>
                                        <th>Specification</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/End Stock Modal-->
        <!-- Import Excel Modal -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="stock/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
							{{ csrf_field() }}
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>
        <!-- End Import Excel Modal -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered show-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Serial Number</th>
                            <th>Category</th>
                            <th>Action</th>
                            <th>Notification</th>
                            <th>Qr</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php $no = 1; @endphp --}}
                        @foreach($products as $product)
                        {{-- {{ $nama_qr = rand() . $product->id }} --}}
                            <tr>
                            {{-- <td>{{ $no++ }}</td> --}}
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->brand }}</td>
                                <td>{{ $product->serial_number }}</td>
                                @isset($product->category->name)
                                    <td>{{ $product->category->name }}</td>
                                    @php
                                        $category_name = $product->category->name;
                                    @endphp
                                @endisset
                                @empty($product->category->name)
                                    <td></td>
                                    @php
                                        $category_name = '';
                                    @endphp
                                @endempty
                                <td class="d-flex">
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#modal" onclick="getProducts({{ $product->id }})">
                                        <i class="fas fa-eye"></i>Detail</a>
                                </td>
                                <td>
                                    @if($product->is_remind == 1)
                                    <a href="{{ route( 'stock.notifunpublished', $product->id ) }}"
                                        class="btn btn-success btn-icon-split btn-sm">
                                        <span class="icon">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Active</span>
                                    </a>
                                    @else
                                    <a href="{{ route( 'stock.notifpublished', $product->id ) }}"
                                        class="btn btn-danger btn-icon-split btn-sm">
                                        <span class="icon">
                                            <i class="fas fa-times-circle"></i>
                                        </span>
                                        <span class="text">Inactive</span>
                                    </a>
                                    @endif
                                </td>
                                {{ QrCode::size(500)->format('png')->generate($product->id . '/' . $category_name . '/' . date('Y', strtotime($product->buy_date)), storage_path('app/public/qr_products/' . $product->id . '.png')) }}
                                <td class="d-flex">
                                    <a href="{{ route('stock.download-qr-code', $product->id) }}" class="btn btn-info btn-icon-split btn-sm mr-2">
                                        <span class="icon">
                                            <i class="fa fa-download"></i>
                                        </span>
                                        <span class="text">Qr</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('admin') }}/js/demo/datatables-demo.js"></script>

    <script>
        function getProducts(id) {
            $.get('stock/view/' + id)
                .done(function (data) {
                    var html = '';
                    data.forEach(function (product) {
                        html += '<tr>'
                        html += '<td>' + product.product_name + '</td>'
                        html += '<td>' + product.brand + '</td>'
                        html += '<td>' + product.price + '</td>'
                        html += '<td>' + product.specification + '</td>'
                        html += '<td>'
                        html += '<a href="stock/edit/'+ product.id +'" class="btn btn-warning btn-circle btn-sm mr-2 btnEdit" ><i class="fas fa-edit"></i></a>'
                        html += '<a href="stock/delete/'+ product.id +'" class="btn btn-danger btn-circle btn-sm mr-2 btnEdit" onclick="if(!confirm('+'Are you sure to delete?'+')) return false"><i class="fas fa-trash"></i></a>'
                        html += '</td> </tr>';
                    })
                    $('.product-table tbody').html(html)
                })
        };
    </script>
@endsection
{{-- date('d F Y', strtotime($tgl) --}}