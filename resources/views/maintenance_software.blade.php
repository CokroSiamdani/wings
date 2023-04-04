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
Maintenance software
@endsection

@section('page-heading')
    <span class="badge badge-primary">Maintenance software</span> -
    <small>Manage Maintenance software</small>
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
            <h6 class="m-0 font-weight-bold text-primary">Manage Maintenance software</h6>
            <a href="{{ route('maintenance_software.add') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                        <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Add New Maintenance software</span>
            </a>
            <a href="{{ url('maintenance_software/cetak_pdf/' . $maintenances_date) }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                        <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Cetak PDF</span>
            </a>
            <a href="{{ url('maintenance_software/view_pdf/' . $maintenances_date) }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                        <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">View PDF</span>
            </a>
            {{-- <a href="{{ url('staff/export_excel') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                        <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Export Excel</span>
            </a> --}}
            {{-- <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                Import Excel
            </button> --}}
        </div>
        <div class="d-flex justify-content-end">
            <label for="maintenance_date" class="col-md-4 col-form-label text-md-right">Maintenance date</label>
            <form action="{{ route('maintenance_software.index') }}" method="GET" enctype="multipart/form-data">
                <div class="d-flex justify-content-end">
                    <input type="date" class="form-control" name="maintenance_date" id="maintenance_date" value="{{ $maintenances_date }}">
                </div>
                <div class="d-flex justify-content-end">
                    <input type="submit" class="btn btn-primary mr-3" value="Search">
                </div>
            </form>
        </div>

        <!--Maintenance software Modal-->

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="add-category"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5 id="exampleModalLabel"><span class="badge badge-primary">Maintenance software Details</span></h5><small>Particular Maintenance software information</small>
                        </div>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered maintenances_software-table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>maintenance_date</th>
                                        <th>client</th>
                                        <th>cloud</th>
                                        <th>vm_name</th>
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

        <!--/End Maintenance software Modal-->

        <!-- Import Excel Modal -->
        
		{{-- <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="staff/import_excel" enctype="multipart/form-data">
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
		</div> --}}

        <!-- End Import Excel Modal -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>maintenance_date</th>
                        <th>client</th>
                        <th>cloud</th>
                        <th>vm_name</th>
                        <th>status</th>
                        <th>restarted</th>
                        <th>description</th>
                        <th>action</th>
                        <th>approval</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>maintenance_date</th>
                        <th>client</th>
                        <th>cloud</th>
                        <th>vm_name</th>
                        <th>status</th>
                        <th>restarted</th>
                        <th>description</th>
                        <th>action</th>
                        <th>approval</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($maintenances_software as $maintenance_software)
                        <tr>
                            <td>{{ $maintenance_software->id }}</td>
                            <td>{{ $maintenance_software->maintenance_date }}</td>
                            <td>{{ $maintenance_software->client }}</td>
                            <td>{{ $maintenance_software->cloud }}</td>
                            <td>{{ $maintenance_software->vm_name }}</td>
                            <td>{{ $maintenance_software->status }}</td>
                            <td>{{ $maintenance_software->restarted }}</td>
                            <td>{{ $maintenance_software->description }}</td>
                            <td class="d-flex">
                                <a href="#" class="btn btn-info btn-icon-split btn-sm mr-2" data-toggle="modal" data-target="#modal" onclick="getMaintenance_software({{ $maintenance_software->id }})">
                                    <span class="icon">
                                      <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="text">View</span>
                                </a>
                            </td>
                            <td>
                                @if($maintenance_software->signed == 1)
                                {{ QrCode::size(25)->generate('Julie Nani Adam') }}
                                <a href="{{ route( 'maintenance_software.unsigned', $maintenance_software->id ) }}"
                                    class="btn btn-success btn-icon-split btn-sm">
                                    <span class="icon">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Signed</span>
                                </a>
                                @else
                                <a href="{{ route( 'maintenance_software.signed', $maintenance_software->id ) }}"
                                    class="btn btn-danger btn-icon-split btn-sm">
                                    <span class="icon">
                                        <i class="fas fa-times-circle"></i>
                                    </span>
                                    <span class="text">Unsigned</span>
                                </a>
                                @endif
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
        function getMaintenance_software(id) {
            $.get('maintenance_software/view/' + id)
                .done(function (data) {
                    console.log(data);
                    var html = '';
                    data.forEach(function (maintenance_software) {
                        html += '<tr>'
                        html += '<td>' + maintenance_software.maintenance_date + '</td>'
                        html += '<td>' + maintenance_software.client + '</td>'
                        html += '<td>' + maintenance_software.cloud + '</td>'
                        html += '<td>' + maintenance_software.vm_name + '</td>'
                        html += '<td>'
                        html += '<a href="maintenance_software/edit/'+ maintenance_software.id +'" class="btn btn-warning btn-circle btn-sm mr-2 btnEdit" ><i class="fas fa-edit"></i></a>'
                        html += '<a href="maintenance_software/delete/'+ maintenance_software.id +'" class="btn btn-danger btn-circle btn-sm mr-2 btnEdit" onclick="if(!confirm('+'Are you sure to delete?'+')) return false"><i class="fas fa-trash"></i></a>'
                        html += '</td> </tr>';
                    })
                    $('.maintenances_software-table tbody').html(html)
                })
        }
    </script>
@endsection