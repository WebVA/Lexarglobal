<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Product_price;
use App\Models\Product_image;
use App\Models\Brand;
use App\Models\Material;
use App\Models\Discard;
use App\Models\Color;
use App\Models\Decoration_method;
use DB;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function show_products($main_category, $sub_category, $brand)
    {
        $setting = [];
        $setting['main_category'] = $main_category;
        $setting['sub_category'] = $sub_category;
        $setting['brand'] = $brand;
        $setting['search'] = '';

        $setting_sub_category = DB::table('sub_categories')->select('*')->where("category_id", "=", $main_category)->get();
        $categorydata = Category::orderBy('category_name', 'ASC')->get();
        $branddata = Brand::orderBy('brand_name', 'ASC')->get();
        $product_value = [];

        if ($main_category || $sub_category || $brand) {
            $query = "SELECT *
            FROM
            (SELECT products.*,categories.category_name
            FROM products
            LEFT JOIN categories ON products.category_id = categories.id)a";

            if ($main_category || $sub_category || $brand) {
                $query .= " WHERE";
                $count = 0;
                if ($brand) {
                    $query .= " brand_name = '" . addslashes($brand) . "'";
                    $count = 1;
                }
                if ($main_category) {
                    if ($count)
                        $query .= " OR";
                    $query .= " category_id = {$main_category}";
                    $count = 1;
                }
                if ($sub_category) {
                    if ($count)
                        $query .= " OR";
                    $query .= " subcategory_id = {$sub_category}";
                    $count = 1;
                }
            }
            // print_r($query);
            $product = DB::select(DB::raw($query));

            foreach ($product as $item) {
                $product_list = [];
                $image = DB::table('product_images')
                    ->select('product_image')
                    ->where('product_id', $item->id)
                    ->orderBy('img_order', 'ASC')
                    ->first();
                $product_list['id'] = $item->id;
                $product_list['product_name'] = $item->product_name;
                $product_list['category'] = $item->category_name;
                $product_list['brand'] = $item->brand_name;
                $product_list['product_image'] = $image ? $image->product_image : "";
                $product_list['sku'] = $item->sku;
                $product_list['price'] = $item->price;
                $product_list['featured'] = $item->featured;
                $product_list['onsale'] = $item->onsale;
                $product_list['status'] = $item->status;
                $product_list['viewed'] = $item->viewed;
                $product_list['discount'] = $item->discount;
                $product_list['percents'] = $item->percents;
                $product_list['modified'] = $item->updated;
                array_push($product_value, $product_list);
            }
        }

        return view('dashboard.products')->with('category', $categorydata)->with('brand', $branddata)->with('product', $product_value)->with('setting', $setting)->with('setting_sub_category', $setting_sub_category);
    }

    public function view_product()
    {
        return view('dashboard.view_product');
    }

    public function add_product()
    {
        $category = Category::orderBy('category_name', 'ASC')->get();
        $decoration_method = Decoration_method::all();
        $brand = Brand::orderBy('brand_name', 'ASC')->get();
        $material = Material::all();
        $discard = Discard::all();
        $color = Color::all();
        return view('dashboard.add_product')->with('category', $category)->with('decoration_method', $decoration_method)->with('brand', $brand)->with('material', $material)->with('color', $color)->with('discard', $discard);
    }

    public function add_product_api(Request $request)
    {
        $product_name =  $request->input('product_name');
        $main_category =  $request->input('main_category');
        $sub_category =  $request->input('sub_category');
        $bland =  $request->input('bland');
        $sku =  $request->input('sku');
        $material =  $request->input('material');
        $featured =  $request->input('featured');
        $on_sale =  $request->input('on_sale');
        $status =  $request->input('status');
        $price_qty =  $request->input('price_qty');
        $onsale =  $request->input('onsale');
        $discount =  $request->input('discount');
        $color_check =  $request->input('color_check');
        $video_link =  $request->input('video_link');
        $retail_price =  $request->input('retail_price');
        $dim_width =  $request->input('dim_width');
        $dim_height =  $request->input('dim_height');
        $dim_depth =  $request->input('dim_depth');
        $master_dimention =  $request->input('master_dimention');
        $master_qty =  $request->input('master_qty');
        $master_weight =  $request->input('master_weight');
        $imprint_width =  $request->input('imprint_width');
        $imprint_height =  $request->input('imprint_height');
        $weight =  $request->input('weight');
        $box_weight =  $request->input('box_weight');
        $item_no =  $request->input('item_no');
        $decoration_method =  $request->input('decoration_method');
        $description_note =  $request->input('description_note');
        $specifications =  $request->input('specifications');
        $imprint_note =  $request->input('imprint_note');
        $note =  $request->input('note');
        $production_note =  $request->input('production_note');
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'product_name' => $product_name,
            'category_id' => $main_category,
            'subcategory_id' => $sub_category,
            'brand_name' => $bland,
            'sku' => $sku,
            'weight' => $weight,
            'box_weight' => $box_weight,
            'item_no' => $item_no,
            'dim_width' => $dim_width,
            'dim_height' => $dim_height,
            'dim_depth' => $dim_depth,
            'master_dimention' => $master_dimention,
            'master_qty' => $master_qty,
            'master_weight' => $master_weight,
            'imprint_width' => $imprint_width,
            'imprint_height' => $imprint_height,
            'colors' => $color_check,
            'status' => $status,
            'description' => $description_note,
            'specification' => $specifications,
            'note' => $note,
            'imprint_note' => $imprint_note,
            'production_note' => $production_note,
            'discount' => $discount,
            'percents' => $onsale,
            'manufacturar' => $material,
            'youtube' => $video_link,
            'featured' => $featured,
            'onsale' => $on_sale,
            'price' => $retail_price,
            'decoration_method' => $decoration_method,
            'created' => $today
        ];
        $result = Product::insert($inputs);
        if ($result) {
            $n_id = Product::max('id');
            foreach ($price_qty as $item) {
                $input = [
                    'product_id' => $n_id,
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'created' => $today
                ];
                Product_price::insert($input);
            }
            return $n_id;
        } else {
            return 0;
        }
    }

    public function upload_product_api(Request $request)
    {
        if ($request->file('upload_files')) {
            $validation = Validator::make($request->all(), [
                'upload_files' => 'image|mimes:jpeg,png,jpg,gif|max:10000'
            ]);
            if ($validation->passes()) {
                $image = $request->file('upload_files');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/product-images'), $new_name);
                $today = date("Y-n-j H:i:s");
                $input = [
                    'product_id' => $request->input('id'),
                    'product_image' => $new_name,
                    'created' => $today
                ];
                Product_image::insert($input);
                return response()->json([
                    'message'   => 'success'
                ]);
            } else {
                return response()->json([
                    'message'   => $validation->errors()->all()
                ]);
            }
        }
    }

    public function edit_product($id)
    {
        $product = DB::table('products')->select('*')->where("id", "=", $id)->get();
        $category = Category::orderBy('category_name', 'ASC')->get();
        $decoration_method = Decoration_method::all();
        $sub_category = DB::table('sub_categories')->select('*')->where("category_id", "=", $product[0]->category_id)->get();
        $brand = Brand::orderBy('brand_name', 'ASC')->get();
        $material = Material::all();
        $price_list = DB::table('product_prices')->select('*')->where("product_id", "=", $id)->get();
        $discard = Discard::all();
        $color = Color::all();
        $image = DB::table('product_images')->select('*')->where("product_id", "=", $id)->orderBy('img_order', 'ASC')->get();
        return view('dashboard.edit_product')->with('product', $product)->with('category', $category)->with('decoration_method', $decoration_method)
            ->with('sub_category', $sub_category)->with('brand', $brand)->with('material', $material)->with('price_list', $price_list)->with('discard', $discard)->with('color', $color)->with('image', $image);
    }

    public function edit_product_api(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_name =  $request->input('product_name');
        $product_name = str_replace("'", "", $product_name);
        $main_category =  $request->input('main_category');
        $sub_category =  $request->input('sub_category');
        $bland =  $request->input('bland');
        $sku =  $request->input('sku');
        $material =  $request->input('material');
        $featured =  $request->input('featured');
        $on_sale =  $request->input('on_sale');
        $status =  $request->input('status');
        $price_qty =  $request->input('price_qty');
        $onsale =  $request->input('onsale');
        $discount =  $request->input('discount');
        $color_check =  $request->input('color_check');
        $video_link =  $request->input('video_link');
        $retail_price =  $request->input('retail_price');
        $dim_width =  $request->input('dim_width');
        $dim_height =  $request->input('dim_height');
        $dim_depth =  $request->input('dim_depth');
        $master_dimention =  $request->input('master_dimention');
        $master_qty =  $request->input('master_qty');
        $master_weight =  $request->input('master_weight');
        $imprint_width =  $request->input('imprint_width');
        $imprint_height =  $request->input('imprint_height');
        $weight =  $request->input('weight');
        $box_weight =  $request->input('box_weight');
        $item_no =  $request->input('item_no');
        $decoration_method =  $request->input('decoration_method');
        $description_note =  $request->input('description_note');
        $description_note = str_replace("'", "", $description_note);
        $specifications =  $request->input('specifications');
        $specifications = str_replace("'", "", $specifications);
        $imprint_note =  $request->input('imprint_note');
        $imprint_note = str_replace("'", "", $imprint_note);
        $note =  $request->input('note');
        $note = str_replace("'", "", $note);
        $production_note =  $request->input('production_note');
        $production_note = str_replace("'", "", $production_note);
        // $can_upload = $request->input('can_upload');
        $today = date("Y-n-j H:i:s");
        $query = "UPDATE products SET product_name = '" . $product_name . "', category_id = '{$main_category}',subcategory_id = '{$sub_category}',brand_name = '" . addslashes($bland) . "',sku = '{$sku}',weight = '{$weight}',box_weight = '{$box_weight}',item_no = '{$item_no}',dim_width = '{$dim_width}',dim_height = '{$dim_height}',dim_depth = '{$dim_depth}',master_dimention = '{$master_dimention}',master_qty = '{$master_qty}',master_weight = '{$master_weight}',imprint_width = '{$imprint_width}',imprint_height = '{$imprint_height}',colors = '{$color_check}',status = '{$status}',description = '{$description_note}',specification = '{$specifications}',note = '{$note}',imprint_note = '{$imprint_note}',production_note = '{$production_note}',discount = '{$discount}',percents = '{$onsale}',manufacturar = '{$material}',youtube = '{$video_link}',featured = '{$featured}',onsale = '{$on_sale}',price = '{$retail_price}',decoration_method = '{$decoration_method}', updated = '{$today}' where id = {$product_id}";
        // print_r($query);
        $result = DB::statement($query);

        if ($result) {
            DB::table('product_prices')->where('product_id', '=', $product_id)->delete();

            foreach ($price_qty as $item) {
                $input = [
                    'product_id' => $product_id,
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'created' => $today
                ];
                Product_price::insert($input);
            }
            return 1;
        } else {
            return 0;
        }
    }

    public function edit_product_image_api(Request $request)
    {
        if ($request->file('upload_files')) {
            $validation = Validator::make($request->all(), [
                'upload_files' => 'image|mimes:jpeg,png,jpg,gif|max:10000'
            ]);
            if ($validation->passes()) {
                $image = $request->file('upload_files');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/product-images'), $new_name);
                $today = date("Y-n-j H:i:s");
                $input = [
                    'product_id' => $request->input('id'),
                    'product_image' => $new_name,
                    'created' => $today
                ];
                Product_image::insert($input);

                $inserted_img = DB::table('product_images')->select('*')->where("product_id", "=", $request->input('id'))->where("product_image", "=", $new_name)->where("created", "=", $today)->get();

                return response()->json([
                    'message'   => $inserted_img[0]->id
                ]);
            } else {
                return response()->json([
                    'message'   => $validation->errors()->all()
                ]);
            }
        } else {
            echo $request->input('id');
        }
    }

    public function remove_image_api()
    {
        $id =  request()->id;
        $result = DB::table('product_images')->where('id', '=', $id)->delete();
        return $result;
    }

    public function set_img_order_api()
    {
        foreach (request()->img_order as $item) {
            $result = DB::statement("UPDATE product_images SET img_order = " . $item['order'] . " where id = " . $item['id']);
            print_r($result);
        }
    }

    public function get_sub_category_api()
    {
        $sub_category = DB::table('sub_categories')->select('*')->where("category_id", "=", request()->id)->get();
        return $sub_category;
    }

    public function set_sub_category_api()
    {
        $sub_category = [];
        foreach (request()->id as $item) {
            $sigle_sub_category = DB::table('sub_categories')->select('*')->where("category_id", "=", $item)->get();
            foreach ($sigle_sub_category as $item1) {
                array_push($sub_category, $item1);
            }
        }
        return $sub_category;
    }

    public function search_product_by_key($key)
    {
        if (strpos($key, "_lol_")) {
            $key = str_replace("_lol_", "/", $key);
        }
        $setting = [];
        $setting['main_category'] = 0;
        $setting['sub_category'] = 0;
        $setting['brand'] = '';
        $setting['search'] = $key;

        $setting_sub_category = DB::table('sub_categories')->select('*')->where("category_id", "=", 0)->get();
        $categorydata = Category::orderBy('category_name', 'ASC')->get();
        $branddata = Brand::orderBy('brand_name', 'ASC')->get();
        $product_value = [];

        $query = "SELECT *
        FROM
        (SELECT products.*,categories.category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id)a
        WHERE product_name LIKE '%" . addslashes($key) . "%' OR brand_name LIKE '%" . addslashes($key) . "%' OR sku LIKE '%" . addslashes($key) . "%'";            // print_r($query);

        $product = DB::select(DB::raw($query));

        foreach ($product as $item) {
            $product_list = [];
            $image = DB::table('product_images')
                ->select('product_image')
                ->where('product_id', $item->id)
                ->orderBy('img_order', 'ASC')
                ->first();
            $product_list['id'] = $item->id;
            $product_list['product_name'] = $item->product_name;
            $product_list['category'] = $item->category_name;
            $product_list['brand'] = $item->brand_name;
            $product_list['product_image'] = $image ? $image->product_image : "";
            $product_list['sku'] = $item->sku;
            $product_list['price'] = $item->price;
            $product_list['featured'] = $item->featured;
            $product_list['onsale'] = $item->onsale;
            $product_list['status'] = $item->status;
            $product_list['viewed'] = $item->viewed;
            $product_list['discount'] = $item->discount;
            $product_list['percents'] = $item->percents;
            $product_list['modified'] = $item->updated;
            array_push($product_value, $product_list);
        }

        return view('dashboard.products')->with('category', $categorydata)->with('brand', $branddata)->with('product', $product_value)->with('setting', $setting)->with('setting_sub_category', $setting_sub_category);
    }

    public function del_product_api()
    {
        $id =  request()->id;
        return DB::table('products')->where('id', '=', $id)->delete();
    }
}
