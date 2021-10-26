<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class UOtherController extends Controller
{
    public function aboutus()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.aboutus')->with("brand", $brand);
    }

    public function faq()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.faq')->with("brand", $brand);
    }

    public function policy()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.policy')->with("brand", $brand);
    }

    public function international()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.international')->with("brand", $brand);
    }

    public function artwork()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.artwork')->with("brand", $brand);
    }

    public function refund()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.refund')->with("brand", $brand);
    }

    public function shipping_policies()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.shipping_policies')->with("brand", $brand);
    }

    public function solution()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.solution')->with("brand", $brand);
    }
}
