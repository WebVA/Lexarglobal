<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Wishlist;
use DB;
use Illuminate\Http\Request;

class UWishlistController extends Controller
{
    public function index()
    {
        if (session()->has('logged_customer')) {
            $brand = Brand::where('status', 1)->limit(30)->get();
            $customer = session()->get('logged_customer', '')->id;
            $wishlist = DB::select(DB::raw("SELECT wishlists.*,products.product_name,products.sku,products.price FROM wishlists, products WHERE wishlists.product_id = products.id AND wishlists.customer_id = {$customer} ORDER BY wishlists.created"));
            $productddata = [];
            foreach ($wishlist as $item) {
                $product_list = [];
                $image = DB::table('product_images')->select('product_image')->where('product_id', $item->product_id)->orderBy('img_order', 'ASC')->first();
                $eqp = DB::select(DB::raw("SELECT MIN(price) as eqp FROM product_prices WHERE product_id = {$item->product_id}"));
                $product_list['id'] = $item->id;
                $product_list['product_id'] = $item->product_id;
                $product_list['product_name'] = $item->product_name;
                $product_list['product_image'] = $image ? $image->product_image : "";
                $product_list['sku'] = $item->sku;
                $product_list['eqp'] = $eqp[0]->eqp;
                array_push($productddata, $product_list);
            }
            return view('user.wishlist')->with("brand", $brand)->with("wishlist", $productddata);
        } else {
            $brand = Brand::where('status', 1)->limit(30)->get();
            return view('user.login')->with("brand", $brand);
        }
    }

    public function add_wishlist_api(Request $request)
    {
        if (session()->has('logged_customer')) {
            $id = $request->input('id');
            $customer = session()->get('logged_customer', '')->id;
            $today = date("Y-n-j H:i:s");
            $inputs = [
                'customer_id' => $customer,
                'product_id' => $id,
                'created' => $today
            ];
            $result = Wishlist::insert($inputs);
            $last = DB::select(DB::raw("SELECT wishlists.*, products.product_name FROM wishlists, products WHERE wishlists.product_id = products.id ORDER BY wishlists.id DESC LIMIT 1"));
            $image = DB::table('product_images')
                ->select('product_image')
                ->where('product_id', $last[0]->product_id)
                ->orderBy('img_order', 'ASC')
                ->first();
            $product_detail = [];
            $product_detail['id'] = $last[0]->id;
            $product_detail['product_name'] = $last[0]->product_name;
            $product_detail['product_image'] = $image ? $image->product_image : "";

            $return_data = [];
            if ($result) {
                $return_data['result'] = $product_detail;
                $return_data['type'] = 'success';
                return json_encode($return_data);
            } else {
                $return_data['result'] = '';
                $return_data['type'] = 'error';
                return json_encode($return_data);
            }
        } else {
            $return_data['result'] = '';
            $return_data['type'] = 'login';
            return json_encode($return_data);
        }
    }

    public function del_wishlist_api()
    {
        $id =  request()->id;
        return DB::table('wishlists')->where('id', '=', $id)->delete();
    }
}
