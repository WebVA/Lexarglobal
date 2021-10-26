<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Country;
use App\Models\Customer;
use App\Models\State;
use Illuminate\Http\Request;

class UProfileController extends Controller
{
    public function profile()
    {
        if (session()->has('logged_customer')) {
            $brand = Brand::where('status', 1)->limit(30)->get();
            $country = Country::all();
            $state = State::all();
            $id = session()->get('logged_customer')->id;
            $customer_data = Customer::where('id', $id)->first();
            return view('user.profile')->with("brand", $brand)->with("country", $country)->with("state", $state)->with("customer_data", $customer_data);
        } else {
            $brand = Brand::where('status', 1)->limit(30)->get();
            return view('user.login')->with("brand", $brand);
        }
    }

    public function change_pwd_api()
    {
        $id = session()->get('logged_customer')->id;
        $realpwd = Customer::select('password')->where('id', $id)->first();
        $oldpwd = request()->oldpwd;
        $newpwd = request()->newpwd;
        $today = date("Y-n-j H:i:s");
        if ($realpwd->password == $oldpwd) {
            $customer = Customer::find($id);
            $customer->password = $newpwd;
            $customer->modified = $today;
            $customer->save();
            if ($customer->wasChanged()) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }

    public function change_profile_api()
    {
        $id = session()->get('logged_customer')->id;
        $customer = Customer::find($id);
        $customer->firstname = request()->firstname;
        $customer->lastname = request()->lastname;
        $customer->company_name = request()->company;
        $customer->industry_number = request()->asi_num;
        $customer->sage_number = request()->sage_num;
        $customer->mobile_phone = request()->mobile_num;
        $customer->fax_number = request()->fax_num;
        $customer->land_phone = request()->land_num;
        $customer->office_number = request()->office_num;
        $customer->city = request()->city;
        $customer->zip = request()->zip;
        $customer->state = request()->state;
        $customer->modified = date("Y-n-j H:i:s");
        $customer->save();
        if ($customer->wasChanged()) {
            return 1;
        } else {
            return 2;
        }
    }

    public function myaccount()
    {
        if (session()->has('logged_customer')) {
            $brand = Brand::where('status', 1)->limit(30)->get();
            return view('user.myaccount')
                ->with("brand", $brand);
        } else {
            $brand = Brand::where('status', 1)->limit(30)->get();
            return view('user.login')
                ->with("brand", $brand);
        }
    }

    public function address()
    {
        if (session()->has('logged_customer')) {
            $brand = Brand::where('status', 1)->limit(30)->get();
            $state = State::all();
            $id = session()->get('logged_customer')->id;
            $customer_data = Customer::where('id', $id)->first();
            return view('user.address')->with("brand", $brand)->with("state", $state)->with("customer_data", $customer_data);
        } else {
            $brand = Brand::where('status', 1)->limit(30)->get();
            return view('user.login')->with("brand", $brand);
        }
    }

    public function change_address_api()
    {
        $id = session()->get('logged_customer')->id;
        $customer = Customer::find($id);
        $customer->shipping_address1 = request()->ship_address1;
        $customer->shipping_address2 = request()->ship_address2;
        $customer->shipping_city = request()->ship_city;
        $customer->shipping_state = request()->ship_state;
        $customer->shipping_zip = request()->ship_zip;
        $customer->bill_address1 = request()->bill_address1;
        $customer->bill_address2 = request()->bill_address2;
        $customer->bill_city = request()->bill_city;
        $customer->bill_state = request()->bill_state;
        $customer->bill_zip = request()->bill_zip;
        $customer->modified = date("Y-n-j H:i:s");
        $customer->save();
        if ($customer->wasChanged()) {
            return 1;
        } else {
            return 2;
        }
    }
}
