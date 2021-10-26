<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Country;
use App\Models\State;
use DB;
use Illuminate\Http\Request;

class ULoginController extends Controller
{
    public function login()
    {
        if (session()->has('logged_customer')) {
            $brand = Brand::where('status', 1)->limit(30)->get();
            $country = Country::all();
            $state = State::all();
            return view('user.myaccount')->with("brand", $brand)->with("country", $country)->with("state", $state);
        } else {
            $brand = Brand::where('status', 1)->limit(30)->get();
            return view('user.login')->with("brand", $brand);
        }
    }

    public function login_check_api(Request $request)
    {
        $email =  request()->email;
        $pwd =  request()->password;
        $customer = DB::table('customers')->select('*')->where('email', $email)->where('password', $pwd)->first();
        $brand = Brand::where('status', 1)->limit(30)->get();
        $country = Country::all();
        $state = State::all();
        if ($customer) {
            session(['logged_customer' => $customer]);
            return redirect()->route('myaccount')->with("brand", $brand)->with("country", $country)->with("state", $state);
        } else {
            return view('user.login')->with("brand", $brand);
        }
    }

    public function logout()
    {
        session()->forget('logged_customer');

        return redirect()->route('login');
    }

    public function register()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        $country = Country::all();
        $state = State::all();
        return view('user.register')->with("brand", $brand)->with("country", $country)->with("state", $state);
    }

    public function register_api()
    {
        $company_name =  request()->company_name;
        $firstname =  request()->firstname;
        $lastname =  request()->lastname;
        $email =  request()->email;
        $password =  request()->password;
        $industry_number =  request()->industry_number;
        $sage_number =  request()->sage_number;
        $phone_number =  request()->phone_number;
        $fax_number =  request()->fax_number;
        $cell_number =  request()->cell_number;
        $address =  request()->address;
        $city =  request()->city;
        $zip =  request()->zip;
        $state =  request()->state;
        $country =  request()->country;
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'industry_number' => $industry_number,
            'sage_number' => $sage_number,
            'mobile_phone' => $phone_number,
            'fax_number' => $fax_number,
            'land_phone' => $cell_number,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'zip' => $zip,
            'state' => $state,
            'company_name' => $company_name,
            'created' => $today
        ];
        

        $result = Customer::insert($inputs);
        if ($result) {
            return redirect()->route('login');
        } else {
            $brand = Brand::where('status', 1)->limit(30)->get();
            $country = Country::all();
            $state = State::all();
            return view('user.register')->with("brand", $brand)->with("country", $country)->with("state", $state);
        }
    }
}
