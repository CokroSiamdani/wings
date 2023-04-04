<?php

namespace App\Http\Controllers;

use App\Staff;
use App\ProductStaff;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use stdClass;
use Symfony\Component\VarDumper\VarDumper;


// class product_staff_obj
// {
//     var $id;
//     var $nama_staff;
//     var $product_name;
// }

class ProductStaffController extends Controller
{
    public function index()
    {
        $product_staffs = ProductStaff::get();
        return view('product_staff', compact('product_staffs'));
    }

    public function add()
    {
        $staff = Staff::orderBy('nama_staff', 'ASC')->get();
        $product = Product::orderBy('product_name', 'ASC')->get();
        return view('add-product_staff')->with(['staffs' => $staff, 'products' => $product]);
    }

    public function save(Request $request)
    {
        $product_staff = new ProductStaff();

        $product_staff->product_id = $request->product_name;
        $product_staff->staff_id = $request->nama_staff;

        $product_staff->save();

        Session::flash('message', 'Insert Assignment Successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('product_staff.add');
    }

    public function details($id)
    {
        $product_staff = ProductStaff::where('id', $id)->first();
        $staff = Staff::where('id', $product_staff->staff_id)->first();
        $product = Product::where('id', $product_staff->product_id)->first();

        $product_staff_arr = [$id, $staff->nama_staff, $product->product_name];

        return $product_staff_arr;
        // $product_staff_obj = new stdClass;
        // $product_staff_obj = new product_staff_obj();
        // $product_staff_arr = [];
        // array_push($product_staff_arr, $id, $staff->nama_staff, $product->product_name);
        // var_dump($product_staff_arr);

        // $product_staff_arr = array(
        //     "id" => $id,
        //     "nama_staff" => $staff->nama_staff,
        //     "product_name" => $product->product_name
        // );

        // var_dump($product_staff_arr);

        // $product_staff_obj->id = $id;
        // $product_staff_obj->nama_staff = $staff->nama_staff;
        // $product_staff_obj->product_name = $product->product_name;
        // var_dump($product_staff_obj);
        // var_dump($product_staff_obj->product_name);
        // $output = response()->json([$product_staff_obj]);
        // $output = json_encode($product_staff_obj);
        // $output = utf8_encode(response()->json($product_staff_obj));
        // var_dump($output);
        // return $output;
        // return json_decode($output);
        // return $product_staff_obj;
        // return response()->json($product_staff_obj);
        // return Staff::where('id', $id)->get();
    }

    public function edit($id)
    {
        $product_staffs = ProductStaff::where('id', $id)->first();
        $staffs = Staff::where('id', $product_staffs->staff_id)->first();
        $products = Product::orderBy('product_name', 'ASC')->get();
        return view('edit-product_staff')->with(['product_staffs' => $product_staffs, 'staffs' => $staffs, 'products' => $products]);
    }

    public function update(Request $request)
    {
        // dd($request);
        $product_staff = ProductStaff::where('id', $request->id)->first();
        // var_dump($product_staff);
        $product_staff->product_id = $request->product_id;

        $product_staff->save();

        Session::flash('message', 'Assignment Updated Successfully!');
        Session::flash('alert_type', 'alert-success');
        return redirect()->route('product_staff.index');
    }

    public function delete(Request $request)
    {
        $product_staff = ProductStaff::find($request->id);
        $product_staff->delete();
        Session::flash('message', $product_staff->id . ' is deleted!');
        Session::flash('alert_type', 'alert-danger');
        return redirect()->route('product_staff.index');
    }
}
