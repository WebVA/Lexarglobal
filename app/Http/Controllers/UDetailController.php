<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\State;
use App\Models\Product_view;
use DB;
use Illuminate\Http\Request;

class UDetailController extends Controller
{
    public function index($id)
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        $product = DB::table('products')->select('*')->where("id", "=", $id)->first();
        $product_image = DB::table('product_images')->select('*')->where("product_id", "=", $id)->orderBy('img_order', 'ASC')->get();
        // $product_rating = DB::select(DB::raw("SELECT CONVERT(AVG(product_rating),INT) AS rating FROM product_ratings WHERE product_id = ".$id));
        $price_list = DB::table('product_prices')->select('*')->where("product_id", "=", $id)->orderBy("quantity", "ASC")->get();
        $product_color = explode(",", $product->colors);
        $allstate = State::all();

        $relative_product_data = [];
        $relative_product = DB::table('products')->select('*')->where("category_id", "=", $product->category_id)->where("subcategory_id", "=", $product->subcategory_id)->where("id", "!=", $product->id)->limit(4)->get();
        foreach ($relative_product as $item) {
            $product_list = [];
            $image = DB::table('product_images')->select('product_image')->where('product_id', $item->id)->orderBy('img_order', 'ASC')->first();
            $eqp = DB::select(DB::raw("SELECT MIN(price) as eqp FROM product_prices WHERE product_id = {$item->id}"));
            $product_list['id'] = $item->id;
            $product_list['product_name'] = $item->product_name;
            $product_list['category_id'] = $item->category_id;
            $product_list['subcategory_id'] = $item->subcategory_id;
            $product_list['product_image'] = $image ? $image->product_image : "";
            $product_list['sku'] = $item->sku;
            $product_list['brand_name'] = $item->brand_name;
            $product_list['price'] = $item->price;
            $product_list['featured'] = $item->featured;
            $product_list['onsale'] = $item->onsale;
            $product_list['eqp'] = $eqp[0]->eqp;
            array_push($relative_product_data, $product_list);
        }

        $decorationdata = [];
        $decoration_method = DB::select(DB::raw("SELECT decoration_method FROM products WHERE id =" . $id));
        foreach (explode(",", $decoration_method[0]->decoration_method) as $item) {
            $decoration_method_data = DB::table('decoration_methods')->select('name')->where("id", "=", $item)->first();
            if ($decoration_method_data) {
                array_push($decorationdata, $decoration_method_data->name);
            } else {
                array_push($decorationdata, '');
            }
        }
        return view('user.detail')->with("brand", $brand)->with("product", $product)->with("product_image", $product_image)->with("price_list", $price_list)->with("product_color", $product_color)->with("relative_product_data", $relative_product_data)->with("allstate", $allstate)->with("decorationdata", $decorationdata);
        // ->with("product_rating",$product_rating[0]->rating?$product_rating[0]->rating:0);
    }

    public function send_visit_report_api(Request $request)
    {
        $product_id = $request->input('product_id');
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'product_id'  => $product_id,
            'customer_id' => session()->has('logged_customer') ? session()->get('logged_customer')->id : '',
            'view_date'   => $today
        ];
        Product_view::insert($inputs);
    }
}
