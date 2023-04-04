<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance_pc_laptop;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Maintenance_pc_laptop_Controller extends Controller
{
    public function index(Request $request)
    {
        if ($request->maintenance_date) {
            $maintenances_pc_laptop = Maintenance_pc_laptop::where('maintenance_date', $request->maintenance_date)->get();
        } else {
            $maintenances_pc_laptop = Maintenance_pc_laptop::get();
        }

        return view('maintenance_pc_laptop')->with([
            'maintenances_pc_laptop' => $maintenances_pc_laptop,
            'maintenances_date' => $request->maintenance_date
        ]);
    }

    public function add()
    {
        return view('add-maintenance_pc_laptop');
    }

    public function save_maintenance_pc_laptop(Request $request)
    {
        $maintenance_pc_laptop = new Maintenance_pc_laptop();

        $maintenance_pc_laptop->maintenance_date = $request->maintenance_date;
        $maintenance_pc_laptop->category = $request->category;
        $maintenance_pc_laptop->item_name = $request->item_name;
        $maintenance_pc_laptop->brand = $request->brand;
        $maintenance_pc_laptop->serial_number = $request->serial_number;
        $maintenance_pc_laptop->user_name = $request->user_name;
        $maintenance_pc_laptop->status = $request->status;
        $maintenance_pc_laptop->password_8_chars = $request->password_8_chars;
        $maintenance_pc_laptop->password_combination = $request->password_combination;
        $maintenance_pc_laptop->description = $request->description;

        $maintenance_pc_laptop->save();

        Session::flash('message', 'Insert maintenance_pc_laptop successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_pc_laptop.add');
    }

    public function maintenance_pc_laptop_details($id)
    {
        return Maintenance_pc_laptop::where('id', $id)->get();
    }

    public function edit($id)
    {
        $maintenances_pc_laptop = Maintenance_pc_laptop::where('id', $id)->first();
        return view('edit-maintenance_pc_laptop')->with(['maintenances_pc_laptop' => $maintenances_pc_laptop]);
    }

    public function update(Request $request)
    {
        $maintenance_pc_laptop = Maintenance_pc_laptop::where('id', $request->id)->first();
        //dd($maintenance_pc_laptop);
        //var_dump($maintenance_pc_laptop);
        $maintenance_pc_laptop->maintenance_date = $request->maintenance_date;
        $maintenance_pc_laptop->category = $request->category;
        $maintenance_pc_laptop->item_name = $request->item_name;
        $maintenance_pc_laptop->brand = $request->brand;
        $maintenance_pc_laptop->serial_number = $request->serial_number;
        $maintenance_pc_laptop->user_name = $request->user_name;
        $maintenance_pc_laptop->status = $request->status;
        $maintenance_pc_laptop->password_8_chars = $request->password_8_chars;
        $maintenance_pc_laptop->password_combination = $request->password_combination;
        $maintenance_pc_laptop->description = $request->description;

        $maintenance_pc_laptop->save();

        Session::flash('message', 'Maintenance_pc_laptop Updated successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_pc_laptop.index');
    }

    public function delete(Request $request)
    {
        $maintenance_pc_laptop = Maintenance_pc_laptop::find($request->id);
        $maintenance_pc_laptop->delete();
        Session::flash('message', $maintenance_pc_laptop->item_name . ' is deleted!');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('maintenance_pc_laptop.index');
    }

    public function unsigned($id)
    {
        $maintenance_pc_laptop = Maintenance_pc_laptop::find($id);
        $maintenance_pc_laptop->signed = 0;
        $maintenance_pc_laptop->save();
        $maintenances_pc_laptop = Maintenance_pc_laptop::where('maintenance_date', $maintenance_pc_laptop->maintenance_date)->get();
        Session::flash('message', $maintenance_pc_laptop->item_name . ' is not approved now.');
        Session::flash('alert_type', 'alert-danger');
        // return redirect()->route('maintenance_pc_laptop.index');
        return view('maintenance_pc_laptop')->with([
            'maintenances_pc_laptop' => $maintenances_pc_laptop,
            'maintenances_date' => $maintenance_pc_laptop->maintenance_date
        ]);
    }

    public function signed($id)
    {
        $maintenance_pc_laptop = Maintenance_pc_laptop::find($id);
        $maintenance_pc_laptop->signed = 1;
        $maintenance_pc_laptop->save();
        $maintenances_pc_laptop = Maintenance_pc_laptop::where('maintenance_date', $maintenance_pc_laptop->maintenance_date)->get();
        Session::flash('message', $maintenance_pc_laptop->item_name . ' is approved now.');
        Session::flash('alert_type', 'alert-danger');
        // return redirect()->route('maintenance_pc_laptop.index');
        return view('maintenance_pc_laptop')->with([
            'maintenances_pc_laptop' => $maintenances_pc_laptop,
            'maintenances_date' => $maintenance_pc_laptop->maintenance_date
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        // $maintenances_pc_laptop = Maintenance_pc_laptop::all();
        $maintenances_pc_laptop = Maintenance_pc_laptop::where('maintenance_date', $request->data)->get();

        $pdf = PDF::loadview('maintenance_pc_laptop_pdf', ['maintenances_pc_laptop' => $maintenances_pc_laptop])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-maintenance_pc_laptop.pdf');
    }

    public function view_pdf(Request $request)
    {
        // $maintenances_pc_laptop = Maintenance_pc_laptop::all();
        $maintenances_pc_laptop = Maintenance_pc_laptop::where('maintenance_date', $request->data)->get();
        // dd($request->data);
        //var_dump($maintenance_pc_laptop);

        // return view('maintenance_pc_laptop_pdf')->with([
        //     'maintenances_pc_laptop' => $maintenances_pc_laptop
        // ]);
        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_pc_laptop_pdf', ['maintenances_pc_laptop' => $maintenances_pc_laptop, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-maintenance_pc_laptop.pdf');
    }
}
