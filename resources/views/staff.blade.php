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
    Staff - Stock Management
@endsection

@section('page-heading')
    <span class="badge badge-primary">Staff</span> -
    <small>Manage Staff</small>
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
            <h6 class="m-0 font-weight-bold text-primary">Manage Staff</h6>
            <a href="{{ route('staff.add') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                        <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Add New Staff</span>
            </a>
            <a href="{{ url('staff/export_excel') }}" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon">
                        <i class="fas fa-plus-square"></i>
                    </span>
                <span class="text">Export Excel</span>
            </a>
            <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                Import Excel
            </button>
        </div>

        <!--Staff Modal-->

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="add-category"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            <h5 id="exampleModalLabel"><span class="badge badge-primary">Staff Details</span></h5><small>Particular transaction information</small>
                        </div>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered staff-table" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>nama_staff</th>
                                        <th>Posisi</th>
                                        <th>Divisi</th>
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

        <!--/End Staff Modal-->

        <!-- Import Excel Modal -->
        
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
		</div>

        <!-- End Import Excel Modal -->

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Staff</th>
                        <th>Posisi</th>
                        <th>Divisi</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nama Staff</th>
                        <th>Posisi</th>
                        <th>Divisi</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($staffs as $staff)
                        <tr>
                            <td>{{ $staff->id }}</td>
                            <td>{{ $staff->nama_staff }}</td>
                            <td>{{ $staff->position }}</td>
                            <td>{{ $staff->division }}</td>
                            <td class="d-flex">
                                <a href="#" class="btn btn-info btn-icon-split btn-sm mr-2" data-toggle="modal" data-target="#modal" onclick="getStaff({{ $staff->id }})">
                                    <span class="icon">
                                      <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="text">View</span>
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
        function getStaff(id) {
            $.get('staff/view/' + id)
                .done(function (data) {
                    console.log(data);
                    var html = '';
                    data.forEach(function (staff) {
                        html += '<tr>'
                        html += '<td>' + staff.nama_staff + '</td>'
                        html += '<td>' + staff.position + '</td>'
                        html += '<td>' + staff.division + '</td>'
                        html += '<td>'
                        html += '<a href="staff/edit/'+ staff.id +'" class="btn btn-warning btn-circle btn-sm mr-2 btnEdit" ><i class="fas fa-edit"></i></a>'
                        html += '<a href="staff/delete/'+ staff.id +'" class="btn btn-danger btn-circle btn-sm mr-2 btnEdit" onclick="if(!confirm('+'Are you sure to delete?'+')) return false"><i class="fas fa-trash"></i></a>'
                        html += '</td> </tr>';
                    })
                    $('.staff-table tbody').html(html)
                })
        }
    </script>
@endsection