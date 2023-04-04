<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return BinaryFileResponse
     */

    public function index()
    {
        $transactions = Transaction::get();
        return view('transaction')->with([
            'transactions' => $transactions
        ]);
    }

    public function download_qr_code($filename)
    {
        $path = public_path('storage/qr_codes/' . $filename . '.png');
        return response()->download($path);
    }

    public function add()
    {
        return view('add-transaction');
    }

    public function save_transaction(Request $request)
    {
        $transaction = new Transaction();

        $transaction->transaction_date = $request->transaction_date;
        $transaction->total_item = $request->total_item;

        if ($request->hasFile('purchase_note')) {
            $transaction->purchase_note = $request->purchase_note->store('public/images');
        }

        $transaction->save();

        Session::flash('message', 'Purchase successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('transaction.add');
    }

    public function transaction_details($id)
    {
        return Transaction::where('id', $id)->get();
    }

    public function edit($id)
    {
        $transactions = Transaction::where('id', $id)->first();
        return view('edit-transaction')->with(['transactions' => $transactions]);
    }

    public function update(Request $request)
    {
        $transaction = Transaction::where('id', $request->id)->first();
        //dd($transaction);
        //var_dump($transaction);
        $transaction->transaction_date = $request->transaction_date;
        $transaction->total_item = $request->total_item;

        if ($request->hasFile('purchase_note')) {
            Storage::disk('local')->delete($transaction->purchase_note);
            $transaction->purchase_note = $request->purchase_note->store('public/images');
        }

        $transaction->save();

        Session::flash('message', 'Supplier Updated successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('transaction.index');
    }

    public function delete(Request $request)
    {
        $transaction = Transaction::find($request->id);
        unlink(storage_path('app/' . $transaction->purchase_note));
        unlink(storage_path('app/public/qr_codes/' . $transaction->id . '.png'));
        $transaction->delete();
        Session::flash('message', $transaction->transaction_date . ' is deleted!');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('transaction.index');
    }
}
