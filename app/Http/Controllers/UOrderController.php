<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class UOrderController extends Controller
{
    public function index()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.order')->with("brand", $brand);
    }
}
