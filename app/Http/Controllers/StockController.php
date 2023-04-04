<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Purchase;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
// use App\Mail;
use App\Mail\ExpiredMail;
use App\Mail\FirstMail;
use App\Mail\SecondMail;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DateInterval;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use PharIo\Manifest\Email;
use Psy\VersionUpdater\IntervalChecker;
use SimpleSoftwareIO\QrCode\DataTypes\Email as DataTypesEmail;
use Symfony\Component\Mime\Email as MimeEmail;

class StockController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('name', 'ASC')->get();
        $supplier = Supplier::orderBy('id', 'DESC')->get();
        return view('add-purchase')->with(['categories' => $category, 'suppliers' => $supplier]);
    }

    public function save_purchase(Request $request)
    {
        // dd($request->buy_date);
        $product = new Product();
        $product->product_name = $request->product;
        $product->specification = $request->specification;
        $product->serial_number = $request->serial_number;
        $product->buy_date = $request->buy_date;
        $product->expired_date = $request->expired_date;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->category_id = $request->category;
        if ($product->expired_date != null) {
            $product->is_remind = '1';
            $product->waktu_remind = Carbon::create($product->expired_date)->subMonth(1);
            $product->repeat_remind = Carbon::create($product->expired_date)->subRealWeek(1);
        }
        $product->save();
        Session::flash('message', 'Add Product successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('stock.manage');
    }

    public function manage()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('stock', compact('products'));
    }

    public function stock_details($id)
    {
        return Product::where('id', $id)->get();
    }

    public function edit($id)
    {
        $products = Product::where('id', $id)->first();
        $suppliers = Supplier::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();
        return view('edit-purchase')->with(['products' => $products, 'suppliers' => $suppliers, 'categories' => $categories]);
    }

    public function update(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        $product->product_name = $request->product;
        $product->specification = $request->specification;
        $product->serial_number = $request->serial_number;
        $product->buy_date = $request->buy_date;
        $product->expired_date = $request->expired_date;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->category_id = $request->category;
        if ($product->expired_date != null) {
            $product->is_remind = '1';
            $product->waktu_remind = Carbon::create($product->expired_date)->subMonth(1);
            $product->repeat_remind = Carbon::create($product->expired_date)->subRealWeek(1);
        }
        $product->save();
        Session::flash('message', 'Product updated successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('stock.manage');
    }

    public function delete($id)
    {
        // $purchase = Purchase::where('box_id', $id)->first();
        $product = Product::where('id', $id)->first();
        // $purchase->supplier->total_balance = $purchase->supplier->total_balance - $purchase->price;
        // $purchase->supplier->save();
        // $purchase->delete();
        unlink(storage_path('app/public/qr_products/' . $id . '.png'));
        $product->delete();
        Session::flash('message', 'Product delete successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('stock.manage');
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

        // upload ke folder excel_from_upload di dalam folder public
        $file->move('storage/excel_from_upload/', $nama_file);
        Excel::import(new ProductsImport, public_path('storage/excel_from_upload/' . $nama_file));
        Session::flash('message', 'Staff imported successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('stock.manage');
    }

    public function notifunpublished($id)
    {
        $data = Product::find($id);
        $data->is_remind = 0;
        $data->save();
        Session::flash('message', $data->product_name . ' Email Notification is Non-active now.');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('stock.manage');
    }

    public function notifpublished($id)
    {
        $data = Product::find($id);
        if ($data->expired_date == null) {
            Session::flash('message', $data->product_name . ' Belum diatur Expired date');
            Session::flash('alert_type', 'alert-danger');
            $data->is_remind = 0;
            $data->save();
        } else {
            $data->is_remind = 1;
            $data->save();
            Session::flash('message', $data->product_name . ' Email Notification is active now.');
            Session::flash('alert_type', 'alert-success');
        }
        return redirect()->route('stock.manage');
    }

    public function download_qr_code($filename)
    {
        $path = public_path('storage/qr_products/' . $filename . '.png');
        return response()->download($path);
    }
}
