<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use DB;
use Illuminate\Http\Request;

class UBrandController extends Controller
{
    public function index()
    {
        $allbrand = Brand::where('status', 1)->get();
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.brand')->with("allbrand", $allbrand)->with("brand", $brand);
    }
}
