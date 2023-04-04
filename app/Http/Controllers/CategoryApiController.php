<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryApiController extends Controller
{
    public function read_category()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return $categories;
    }
}
