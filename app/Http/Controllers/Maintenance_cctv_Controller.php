<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance_cctv;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Maintenance_cctv_Controller extends Controller
{
    public function index(Request $request)
    {
        if ($request->maintenance_date) {
            $maintenances_cctv = Maintenance_cctv::where('maintenance_date', $request->maintenance_date)->get();
        } else {
            $maintenances_cctv = Maintenance_cctv::get();
        }

        return view('maintenance_cctv')->with([
            'maintenances_cctv' => $maintenances_cctv,
            'maintenances_date' => $request->maintenance_date
        ]);
    }

    public function add()
    {
        return view('add-maintenance_cctv');
    }

    public function save_maintenance_cctv(Request $request)
    {
        $maintenance_cctv = new Maintenance_cctv();

        $maintenance_cctv->maintenance_date = $request->maintenance_date;
        $maintenance_cctv->category = $request->category;
        $maintenance_cctv->brand = $request->brand;
        $maintenance_cctv->location = $request->location;
        $maintenance_cctv->status = $request->status;
        $maintenance_cctv->description = $request->description;

        $maintenance_cctv->save();

        Session::flash('message', 'Insert maintenance_cctv successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_cctv.add');
    }

    public function maintenance_cctv_details($id)
    {
        return Maintenance_cctv::where('id', $id)->get();
    }

    public function edit($id)
    {
        $maintenances_cctv = Maintenance_cctv::where('id', $id)->first();
        return view('edit-maintenance_cctv')->with(['maintenances_cctv' => $maintenances_cctv]);
    }

    public function update(Request $request)
    {
        $maintenance_cctv = Maintenance_cctv::where('id', $request->id)->first();
        //dd($maintenance_cctv);
        //var_dump($maintenance_cctv);
        $maintenance_cctv->maintenance_date = $request->maintenance_date;
        $maintenance_cctv->category = $request->category;
        $maintenance_cctv->brand = $request->brand;
        $maintenance_cctv->location = $request->location;
        $maintenance_cctv->status = $request->status;
        $maintenance_cctv->description = $request->description;

        $maintenance_cctv->save();

        Session::flash('message', 'Maintenance_cctv Updated successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_cctv.index');
    }

    public function delete(Request $request)
    {
        $maintenance_cctv = Maintenance_cctv::find($request->id);
        $maintenance_cctv->delete();
        Session::flash('message', $maintenance_cctv->brand . ' is deleted!');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('maintenance_cctv.index');
    }

    public function unsigned($id)
    {
        $maintenance_cctv = Maintenance_cctv::find($id);
        $maintenance_cctv->signed = 0;
        $maintenance_cctv->save();
        $maintenances_cctv = Maintenance_cctv::where('maintenance_date', $maintenance_cctv->maintenance_date)->get();
        Session::flash('message', $maintenance_cctv->client . ' is not approved now.');
        Session::flash('alert_type', 'alert-danger');
        return view('maintenance_cctv')->with([
            'maintenances_cctv' => $maintenances_cctv,
            'maintenances_date' => $maintenance_cctv->maintenance_date
        ]);
    }

    public function signed($id)
    {
        $maintenance_cctv = Maintenance_cctv::find($id);
        $maintenance_cctv->signed = 1;
        $maintenance_cctv->save();
        $maintenances_cctv = Maintenance_cctv::where('maintenance_date', $maintenance_cctv->maintenance_date)->get();
        Session::flash('message', $maintenance_cctv->client . ' is approved now.');
        Session::flash('alert_type', 'alert-danger');
        return view('maintenance_cctv')->with([
            'maintenances_cctv' => $maintenances_cctv,
            'maintenances_date' => $maintenance_cctv->maintenance_date
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $maintenances_cctv = Maintenance_cctv::where('maintenance_date', $request->data)->get();

        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_cctv_pdf', ['maintenances_cctv' => $maintenances_cctv, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-maintenance_cctv.pdf');
    }

    public function view_pdf(Request $request)
    {
        $maintenances_cctv = Maintenance_cctv::where('maintenance_date', $request->data)->get();

        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_cctv_pdf', ['maintenances_cctv' => $maintenances_cctv, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-maintenance_cctv.pdf');
    }
}
