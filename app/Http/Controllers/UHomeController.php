<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Homepage_setting;
use App\Models\Popup_setting;
use App\Models\News;
use App\Models\Announcement;
use App\Models\Testimonial;
use App\Models\Subscriber;
use DB;
use Session;

use Illuminate\Http\Request;

class UHomeController extends Controller
{
    public function index()
    {
        $allbrand = Brand::all();
        $news = News::where("status", "=", 1)->get();
        $announcement = Announcement::all();
        $testimonial = Testimonial::all();
        $brand = Brand::where('status', 1)->limit(30)->get();
        $homepage_setting = Homepage_setting::first();
        $category1 = DB::table('categories')->select('*')->where("id", "=", $homepage_setting->category1)->first();
        $category2 = DB::table('categories')->select('*')->where("id", "=", $homepage_setting->category2)->first();
        $category3 = DB::table('categories')->select('*')->where("id", "=", $homepage_setting->category3)->first();
        $category4 = DB::table('categories')->select('*')->where("id", "=", $homepage_setting->category4)->first();
        $category5 = DB::table('categories')->select('*')->where("id", "=", $homepage_setting->category5)->first();
        $category6 = DB::table('categories')->select('*')->where("id", "=", $homepage_setting->category6)->first();
        $popUp=Popup_setting::where('page_type',1)->where('status',1)->get();
   
        if(Session::get('popupHomeCount') != '')
        {
            $oldSess=Session::get('popupHomeCount');
            $newSess=$oldSess + 1;
            Session::put('popupHomeCount',$newSess);
        }
        else
        {
            Session::put('popupHomeCount',1);
        }
        
        Session::put('popupPage','home');

        return view('user.index')->with("brand", $brand)->with("news", $news)->with("announcement", $announcement)->with("testimonial", $testimonial)->with("allbrand", $allbrand)->with("homepage_setting", $homepage_setting)->with("category1", $category1)->with("category2", $category2)->with("category3", $category3)->with("category4", $category4)->with("category5", $category5)->with("category6", $category6)->with('popup_data',$popUp);
    }

    public function send_subscribe(Request $request)
    {
        $subscribermail = $request->input('subscribermail');
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'email_id'  => $subscribermail,
            'created'   => $today
        ];
        Subscriber::insert($inputs);
    }
}
