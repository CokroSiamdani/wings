<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class StockApiController extends Controller
{
    public function read_stock()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return $products;
    }
}
