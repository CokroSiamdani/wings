<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Exports\StaffExcel;
use App\Imports\StaffImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::get();
        return view('staff')->with([
            'staffs' => $staffs
        ]);
    }

    public function add()
    {
        return view('add-staff');
    }

    public function save_staff(Request $request)
    {
        $staff = new Staff();

        $staff->nama_staff = $request->nama_staff;
        $staff->position = $request->position;
        $staff->division = $request->division;

        $staff->save();

        Session::flash('message', 'Insert staff successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('staff.add');
    }

    public function staff_details($id)
    {
        return Staff::where('id', $id)->get();
    }

    public function edit($id)
    {
        $staffs = Staff::where('id', $id)->first();
        return view('edit-staff')->with(['staffs' => $staffs]);
    }

    public function update(Request $request)
    {
        $staff = Staff::where('id', $request->id)->first();
        //dd($staff);
        //var_dump($staff);
        $staff->nama_staff = $request->nama_staff;
        $staff->position = $request->position;
        $staff->division = $request->division;

        $staff->save();

        Session::flash('message', 'Staff Updated successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('staff.index');
    }

    public function delete(Request $request)
    {
        $staff = Staff::find($request->id);
        $staff->delete();
        Session::flash('message', $staff->nama_staff . ' is deleted!');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('staff.index');
    }

    public function export_excel()
    {
        return Excel::download(new StaffExcel, 'staff.xlsx');
    }

    public function import_excel(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // dd($file);

        // upload ke folder file_siswa di dalam folder public
        $file->move('storage/excel_from_upload/', $nama_file);


        Excel::import(new StaffImport, public_path('storage/excel_from_upload/' . $nama_file));

        Session::flash('message', 'Staff imported successfully!');
        Session::flash('alert_type', 'alert-success');

        return redirect()->route('staff.index');
    }
}
