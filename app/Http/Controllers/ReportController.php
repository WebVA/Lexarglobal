<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\State;
use App\Models\Brand;
use App\Models\Sample_order;
use App\Models\Product_rating;
use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function most_viewed_products($main_category, $sub_category, $brand, $state, $start_date, $end_date)
    {
        $setting = [];
        $setting['main_category'] = $main_category;
        $setting['sub_category'] = $sub_category;
        $setting['brand'] = $brand;
        $setting['state'] = $state;
        $setting['start_date'] = $start_date;
        $setting['end_date'] = $end_date;

        $setting_sub_category = DB::table('sub_categories')->select('*')->where("category_id", "=", $main_category)->get();

        $query = "SELECT e.*
                    FROM
                    (SELECT d.*,customers.state
                    FROM
                    (SELECT c.*,sub_categories.subcategory_name
                    FROM 
                    (SELECT b.*,categories.category_name
                    FROM 
                    (SELECT a.*,products.product_name, products.sku, products.brand_name, products.category_id, products.subcategory_id
                    FROM
                    (SELECT COUNT(id) AS view_count,product_id,customer_id,view_date FROM product_viewes";
        if ($start_date && $end_date) {
            $query .= " WHERE view_date BETWEEN '{$start_date}' AND '{$end_date}'";
        }
        $query .= " GROUP BY product_id ORDER BY product_id)a
                    LEFT JOIN products ON products.id = a.product_id)b
                    LEFT JOIN categories ON b.category_id = categories.id)c
                    LEFT JOIN sub_categories ON c.subcategory_id = sub_categories.id)d
                    LEFT JOIN customers ON d.customer_id = customers.id)e";
        if ($main_category || $sub_category || $brand || $state) {
            $query .= " WHERE";
            $count = 0;
            if ($brand) {
                $query .= " brand_name = '{$brand}'";
                $count = 1;
            }
            if ($main_category) {
                if ($count)
                    $query .= " AND";
                $query .= " category_id = {$main_category}";
                $count = 1;
            }
            if ($sub_category) {
                if ($count)
                    $query .= " AND";
                $query .= " subcategory_id = {$sub_category}";
                $count = 1;
            }
            if ($state) {
                if ($count)
                    $query .= " AND";
                $query .= " state = '{$state}'";
                $count = 1;
            }
        }

        $data = DB::select(DB::raw($query));
        $category = Category::all();
        $state = State::all();
        $brand = Brand::all();
        $result = [];
        foreach ($data as $item) {
            $image = DB::table('product_images')->select('product_image')->where('product_id', $item->product_id)->orderBy('img_order', 'ASC')->first();
            $result_val = [];
            $result_val['view_count'] = $item->view_count;
            $result_val['product_name'] = $item->product_name;
            $result_val['product_image'] = $image ? $image->product_image : "";
            $result_val['sku'] = $item->sku;
            $result_val['brand_name'] = $item->brand_name;
            $result_val['category_name'] = $item->category_name;
            $result_val['subcategory_name'] = $item->subcategory_name;
            array_push($result, $result_val);
        }

        return view('dashboard.most_viewed_products')->with('state', $state)->with('brand', $brand)->with('category', $category)->with('result', $result)->with('setting', $setting)->with('setting_sub_category', $setting_sub_category);
    }

    public function sample_order($main_category, $sub_category, $brand, $state, $start_date, $end_date)
    {
        $setting = [];
        $setting['main_category'] = $main_category;
        $setting['sub_category'] = $sub_category;
        $setting['brand'] = $brand;
        $setting['state'] = $state;
        $setting['start_date'] = $start_date;
        $setting['end_date'] = $end_date;

        $setting_sub_category = DB::table('sub_categories')->select('*')->where("category_id", "=", $main_category)->get();

        $query = "SELECT * FROM sample_orders";
        if ($main_category || $sub_category || $brand || $state || $start_date || $end_date) {
            $query .= " WHERE";
            $count = 0;
            if ($start_date && $end_date) {
                $query .= " created BETWEEN '{$start_date}' AND '{$end_date}'";
                $count = 1;
            }
            if ($brand) {
                if ($count)
                    $query .= " AND";
                $query .= " brand_name = '{$brand}'";
                $count = 1;
            }
            if ($main_category) {
                if ($count)
                    $query .= " AND";
                $query .= " category_id = {$main_category}";
                $count = 1;
            }
            if ($sub_category) {
                if ($count)
                    $query .= " AND";
                $query .= " subcategory_id = {$sub_category}";
                $count = 1;
            }
            if ($state) {
                if ($count)
                    $query .= " AND";
                $query .= " state = '{$state}'";
                $count = 1;
            }
        }
        $sample_order = DB::select(DB::raw($query));
        $category = Category::all();
        $state = State::all();
        $brand = Brand::all();
        $result = [];
        foreach ($sample_order as $item) {
            $image = DB::table('product_images')->select('product_image')->where('product_id', $item->product_id)->orderBy('img_order', 'ASC')->first();
            $result_val = [];
            $result_val['id'] = $item->id;
            $result_val['product_name'] = $item->product_name;
            $result_val['customer_name'] = $item->first_name . ' ' . $item->last_name;
            $result_val['product_image'] = $image ? $image->product_image : "";
            $result_val['sku'] = $item->sku;
            $result_val['brand_name'] = $item->brand_name;
            $result_val['category_name'] = $item->category_name;
            $result_val['subcategory_name'] = $item->subcategory_name;
            $result_val['qty'] = $item->quantity;
            $result_val['company_name'] = $item->company_name;
            $result_val['industry_number'] = $item->industry_number;
            $result_val['ship_address'] = $item->ship_address;
            $result_val['created'] = $item->created;
            array_push($result, $result_val);
        }
        return view('dashboard.sample_order')->with('brand', $brand)->with('state', $state)->with('category', $category)->with('result', $result)->with('setting', $setting)->with('setting_sub_category', $setting_sub_category);
    }

    public function product_rating($main_category, $sub_category, $brand, $state, $start_date, $end_date)
    {
        $setting = [];
        $setting['main_category'] = $main_category;
        $setting['sub_category'] = $sub_category;
        $setting['brand'] = $brand;
        $setting['state'] = $state;
        $setting['start_date'] = $start_date;
        $setting['end_date'] = $end_date;

        $setting_sub_category = DB::table('sub_categories')->select('*')->where("category_id", "=", $main_category)->get();

        $query = "SELECT * FROM product_ratings";
        if ($main_category || $sub_category || $brand || $state || $start_date || $end_date) {
            $query .= " WHERE";
            $count = 0;
            if ($start_date && $end_date) {
                $query .= " created BETWEEN '{$start_date}' AND '{$end_date}'";
                $count = 1;
            }
            if ($brand) {
                if ($count)
                    $query .= " AND";
                $query .= " brand_name = '{$brand}'";
                $count = 1;
            }
            if ($main_category) {
                if ($count)
                    $query .= " AND";
                $query .= " category_id = {$main_category}";
                $count = 1;
            }
            if ($sub_category) {
                if ($count)
                    $query .= " AND";
                $query .= " subcategory_id = {$sub_category}";
                $count = 1;
            }
            if ($state) {
                if ($count)
                    $query .= " AND";
                $query .= " state = '{$state}'";
                $count = 1;
            }
        }
        $product_rating = DB::select(DB::raw($query));
        $category = Category::all();
        $state = State::all();
        $brand = Brand::all();
        $result = [];
        foreach ($product_rating as $item) {
            $image = DB::table('product_images')->select('product_image')->where('product_id', $item->product_id)->orderBy('img_order', 'ASC')->first();
            $result_val = [];
            $result_val['id'] = $item->id;
            $result_val['product_name'] = $item->product_name;
            $result_val['customer_name'] = $item->customer_name;
            $result_val['customer_state'] = $item->customer_state;
            $result_val['product_image'] = $image ? $image->product_image : "";
            $result_val['sku'] = $item->sku;
            $result_val['brand_name'] = $item->brand;
            $result_val['category_name'] = $item->category_name;
            $result_val['subcategory_name'] = $item->subcategory_name;
            $result_val['product_rating'] = $item->product_rating;
            $result_val['state'] = $item->state;
            $result_val['created'] = $item->created;
            array_push($result, $result_val);
        }
        return view('dashboard.product_rating')
            ->with('brand', $brand)
            ->with('state', $state)
            ->with('category', $category)
            ->with('result', $result)
            ->with('setting', $setting)
            ->with('setting_sub_category', $setting_sub_category);
    }

    public function recent_search()
    {
        $data = DB::select(DB::raw("SELECT * FROM search ORDER BY id DESC LIMIT 0, 1000"));
        return view('dashboard.recent_search')->with('result', $data);
    }

    public function change_rating_state_api()
    {
        $id =  request()->id;
        $state =  request()->state;
        return DB::statement("UPDATE product_ratings SET state = '{$state}' where id = {$id}");
    }
}
