<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance_email;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Maintenance_email_Controller extends Controller
{
    public function index(Request $request)
    {
        if ($request->maintenance_date) {
            $maintenances_email = Maintenance_email::where('maintenance_date', $request->maintenance_date)->get();
        } else {
            $maintenances_email = Maintenance_email::get();
        }

        return view('maintenance_email')->with([
            'maintenances_email' => $maintenances_email,
            'maintenances_date' => $request->maintenance_date
        ]);
    }

    public function add()
    {
        return view('add-maintenance_email');
    }

    public function save_maintenance_email(Request $request)
    {
        $maintenance_email = new Maintenance_email();

        $maintenance_email->maintenance_date = $request->maintenance_date;
        $maintenance_email->name = $request->name;
        $maintenance_email->email = $request->email;
        $maintenance_email->status = $request->status;
        $maintenance_email->description = $request->description;

        $maintenance_email->save();

        Session::flash('message', 'Insert maintenance_email successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_email.add');
    }

    public function maintenance_email_details($id)
    {
        return Maintenance_email::where('id', $id)->get();
    }

    public function edit($id)
    {
        $maintenances_email = Maintenance_email::where('id', $id)->first();
        return view('edit-maintenance_email')->with(['maintenances_email' => $maintenances_email]);
    }

    public function update(Request $request)
    {
        $maintenance_email = Maintenance_email::where('id', $request->id)->first();
        //dd($maintenance_email);
        //var_dump($maintenance_email);
        $maintenance_email->maintenance_date = $request->maintenance_date;
        $maintenance_email->name = $request->name;
        $maintenance_email->email = $request->email;
        $maintenance_email->status = $request->status;
        $maintenance_email->description = $request->description;

        $maintenance_email->save();

        Session::flash('message', 'Maintenance_email Updated successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_email.index');
    }

    public function delete(Request $request)
    {
        $maintenance_email = Maintenance_email::find($request->id);
        $maintenance_email->delete();
        Session::flash('message', $maintenance_email->email . ' is deleted!');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('maintenance_email.index');
    }

    public function unsigned($id)
    {
        $maintenance_email = Maintenance_email::find($id);
        $maintenance_email->signed = 0;
        $maintenance_email->save();
        $maintenances_email = Maintenance_email::where('maintenance_date', $maintenance_email->maintenance_date)->get();
        Session::flash('message', $maintenance_email->email . ' is not approved now.');
        Session::flash('alert_type', 'alert-danger');
        return view('maintenance_email')->with([
            'maintenances_email' => $maintenances_email,
            'maintenances_date' => $maintenance_email->maintenance_date
        ]);
    }

    public function signed($id)
    {
        $maintenance_email = Maintenance_email::find($id);
        $maintenance_email->signed = 1;
        $maintenance_email->save();
        $maintenances_email = Maintenance_email::where('maintenance_date', $maintenance_email->maintenance_date)->get();
        Session::flash('message', $maintenance_email->email . ' is approved now.');
        Session::flash('alert_type', 'alert-danger');
        return view('maintenance_email')->with([
            'maintenances_email' => $maintenances_email,
            'maintenances_date' => $maintenance_email->maintenance_date
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $maintenances_email = Maintenance_email::where('maintenance_date', $request->data)->get();

        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_email_pdf', ['maintenances_email' => $maintenances_email, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-maintenance_email.pdf');
    }

    public function view_pdf(Request $request)
    {
        $maintenances_email = Maintenance_email::where('maintenance_date', $request->data)->get();

        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_email_pdf', ['maintenances_email' => $maintenances_email, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-maintenance_email.pdf');
    }
}
