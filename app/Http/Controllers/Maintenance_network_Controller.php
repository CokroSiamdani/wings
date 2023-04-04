<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maintenance_network;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Maintenance_network_Controller extends Controller
{
    public function index(Request $request)
    {
        if ($request->maintenance_date) {
            $maintenances_network = Maintenance_network::where('maintenance_date', $request->maintenance_date)->get();
        } else {
            $maintenances_network = Maintenance_network::get();
        }

        return view('maintenance_network')->with([
            'maintenances_network' => $maintenances_network,
            'maintenances_date' => $request->maintenance_date
        ]);
    }

    public function add()
    {
        return view('add-maintenance_network');
    }

    public function save_maintenance_network(Request $request)
    {
        $maintenance_network = new Maintenance_network();

        $maintenance_network->maintenance_date = $request->maintenance_date;
        $maintenance_network->category = $request->category;
        $maintenance_network->brand = $request->brand;
        $maintenance_network->serial_number = $request->serial_number;
        $maintenance_network->power = $request->power;
        $maintenance_network->connection = $request->connection;
        $maintenance_network->restarted = $request->restarted;
        $maintenance_network->description = $request->description;

        $maintenance_network->save();

        Session::flash('message', 'Insert maintenance_network successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_network.add');
    }

    public function maintenance_network_details($id)
    {
        return Maintenance_network::where('id', $id)->get();
    }

    public function edit($id)
    {
        $maintenances_network = Maintenance_network::where('id', $id)->first();
        return view('edit-maintenance_network')->with(['maintenances_network' => $maintenances_network]);
    }

    public function update(Request $request)
    {
        $maintenance_network = Maintenance_network::where('id', $request->id)->first();
        //dd($maintenance_network);
        //var_dump($maintenance_network);
        $maintenance_network->maintenance_date = $request->maintenance_date;
        $maintenance_network->category = $request->category;
        $maintenance_network->brand = $request->brand;
        $maintenance_network->serial_number = $request->serial_number;
        $maintenance_network->power = $request->power;
        $maintenance_network->connection = $request->connection;
        $maintenance_network->restarted = $request->restarted;
        $maintenance_network->description = $request->description;

        $maintenance_network->save();

        Session::flash('message', 'Maintenance_network Updated successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('maintenance_network.index');
    }

    public function delete(Request $request)
    {
        $maintenance_network = Maintenance_network::find($request->id);
        $maintenance_network->delete();
        Session::flash('message', $maintenance_network->brand . ' is deleted!');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('maintenance_network.index');
    }

    public function unsigned($id)
    {
        $maintenance_network = Maintenance_network::find($id);
        $maintenance_network->signed = 0;
        $maintenance_network->save();
        $maintenances_network = Maintenance_network::where('maintenance_date', $maintenance_network->maintenance_date)->get();
        Session::flash('message', $maintenance_network->brand . ' is not approved now.');
        Session::flash('alert_type', 'alert-danger');
        return view('maintenance_network')->with([
            'maintenances_network' => $maintenances_network,
            'maintenances_date' => $maintenance_network->maintenance_date
        ]);
    }

    public function signed($id)
    {
        $maintenance_network = Maintenance_network::find($id);
        $maintenance_network->signed = 1;
        $maintenance_network->save();
        $maintenances_network = Maintenance_network::where('maintenance_date', $maintenance_network->maintenance_date)->get();
        Session::flash('message', $maintenance_network->brand . ' is approved now.');
        Session::flash('alert_type', 'alert-danger');
        return view('maintenance_network')->with([
            'maintenances_network' => $maintenances_network,
            'maintenances_date' => $maintenance_network->maintenance_date
        ]);
    }

    public function cetak_pdf(Request $request)
    {
        $maintenances_network = Maintenance_network::where('maintenance_date', $request->data)->get();

        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_network_pdf', ['maintenances_network' => $maintenances_network, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->download('laporan-maintenance_network.pdf');
    }

    public function view_pdf(Request $request)
    {
        $maintenances_network = Maintenance_network::where('maintenance_date', $request->data)->get();

        $qrcode = base64_encode(QrCode::format('svg')->size(25)->errorCorrection('H')->generate('Julie Nani Adam'));
        $pdf = PDF::loadview('maintenance_network_pdf', ['maintenances_network' => $maintenances_network, 'qrcode' => $qrcode])->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-maintenance_network.pdf');
    }
}
