<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\State;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Redirect;

class UContactusController extends Controller
{
    public function index()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        $state = State::all();
        return view('user.contact')->with("state", $state)->with("brand", $brand);
    }

    public function contactus_api()
    {
        $inputs = [
            'customer_name' => request()->name,
            'company_name' => request()->cname,
            'company_position' => request()->pos_com,
            'industry_num' => request()->inum,
            'address1' => request()->adr1,
            'address2' => request()->adr2,
            'city' => request()->city,
            'state' => request()->state,
            'zip' => request()->zip,
            'email1' => request()->email1,
            'email2' => request()->email2,
            'office_phone' => request()->office_phone,
            'mobile_phone' => request()->mobile_phone,
            'comment' => request()->message,
            'preffered_method' => (request()->pemail ? 'email' : '') . (request()->pphone ? 'phone' : ''),
            'contact_date' => date("Y-n-j H:i:s")
        ];
        $result = Contactus::insert($inputs);
        return Redirect::back();
    }
}
