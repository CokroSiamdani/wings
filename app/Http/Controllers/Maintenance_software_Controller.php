<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance_software;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Maintenance_software_Controller extends Controller
{
    public function index(Request $request)
    {
        if ($request->maintenance_date) {
            $maintenances_software = Maintenance_software::where('maintenance_date', $request->maintenance_date)->get();
        } else {
            $maintenances_software = Maintenance_software::get();
        }

        return view('maintenance_software')->with([
            'maintenances_software' => $maintenances_software,
            'maintenances_date' => $request->maintenance_date
        ]);
    }

    public function add()
    {
        return view('add-maintenance_software');
    }

    public function save_maintenance_software(Request $request)
    {
        $maintenance_software = new Maintenance_software();

        $maintenance_software->maintenance_date = $request->maintenance_date;
        $maintenance_software->client = $request->client;
        $maintenance_software->cloud = $request->cloud;
        $maintenance_software->vm_name = $request->vm_name;
        $maintenance_software->status = $request->status;
        $maintenance_software->restarted = $request->restarted;
        $maintenance_software->description = $request->description;

        $maintenance_software->save();

        Session::flash('message', 'Insert maintenance_software successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_software.add');
    }

    public function maintenance_software_details($id)
    {
        return Maintenance_software::where('id', $id)->get();
    }

    public function edit($id)
    {
        $maintenances_software = Maintenance_software::where('id', $id)->first();
        return view('edit-maintenance_software')->with(['maintenances_software' => $maintenances_software]);
    }

    public function update(Request $request)
    {
        $maintenance_software = Maintenance_software::where('id', $request->id)->first();
        //dd($maintenance_software);
        //var_dump($maintenance_software);
        $maintenance_software->maintenance_date = $request->maintenance_date;
        $maintenance_software->client = $request->client;
        $maintenance_software->cloud = $request->cloud;
        $maintenance_software->vm_name = $request->vm_name;
        $maintenance_software->status = $request->status;
        $maintenance_software->restarted = $request->restarted;
        $maintenance_software->description = $request->description;

        $maintenance_software->save();

        Session::flash('message', 'Maintenance_software Updated successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_software.index');
    }

    public function delete(Request $request)
    {
        $maintenance_software = Maintenance_software::find($request->id);
        $maintenance_software->delete();
        Session::flash('message', $maintenance_software->client . ' is deleted!');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('maintenance_software.index');
    }

    public function unsigned($id)
    {
        $maintenance_software = Maintenance_software::find($id);
        $maintenance_software->signed = 0;
        $maintenance_software->save();
        $maintenances_software = Maintenance_software::where('maintenance_date', $maintenance_software->maintenance_date)->get();
        Session::flash('message', $maintenance_software->client . ' is not approved now.');
        Session::flash('alert_type', 'alert-danger');
        return view('maintenance_software')->with([
            'maintenances_software' => $maintenances_software,
            'maintenances_date' => $maintenance_software->maintenance_date
        ]);
    }

    public function signed($id)
    {
        $maintenance_software = Maintenance_software::find($id);
        $maintenance_software->signed = 1;
        $maintenance_software->save();
        $maintenances_software = Maintenance_software::where('maintenance_date', $maintenance_software->maintenance_date)->get();
        Session::flash('message', $maintenance_software->client . ' is approved now.');
        Session::flash('alert_type', 'alert-danger');
        return view('maintenance_software')->with([
            'maintenances_software' => $maintenances_software,
            'maintenances_date' => $maintenance_software->maintenance_date
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $maintenances_software = Maintenance_software::where('maintenance_date', $request->data)->get();

        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_software_pdf', ['maintenances_software' => $maintenances_software, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-maintenance_software.pdf');
    }

    public function view_pdf(Request $request)
    {
        $maintenances_software = Maintenance_software::where('maintenance_date', $request->data)->get();

        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_software_pdf', ['maintenances_software' => $maintenances_software, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-maintenance_software.pdf');
    }
}
