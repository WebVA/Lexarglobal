<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_category;
use DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show_categories()
    {
        $category = Category::all();
        $category_value = [];
        foreach ($category as $item) {
            $category_list = [];
            $subcategory_value = [];
            $subcategory = DB::table('sub_categories')->select('*')->where('category_id', $item->id)->get();
            foreach ($subcategory as $subitem) {
                $subcategory_list = [];
                $subcategory_list['id'] = $subitem->id;
                $subcategory_list['subcategory_name'] = $subitem->subcategory_name;
                array_push($subcategory_value, $subcategory_list);
            }
            $category_list['id'] = $item->id;
            $category_list['category_name'] = $item->category_name;
            $category_list['subcategory'] = $subcategory_value;
            array_push($category_value, $category_list);
        }
        $str = "";
        foreach ($category as $temp) {
            $str .= "<option value='" . $temp->id . "'>" . $temp->category_name . "</option>";
        }
        return view('dashboard.categories')->with('category', $category)->with('result', $category_value)->with('str', $str);
    }

    public function add_category_api()
    {
        $name =  request()->name;
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'category_name' => $name,
            'created' => $today
        ];
        return Category::insert($inputs);
    }

    public function add_subcategory_api()
    {
        $category =  request()->category;
        $subcategory =  request()->subcategory;
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'category_id' => $category,
            'subcategory_name' => $subcategory,
            'created' => $today
        ];
        return Sub_category::insert($inputs);
    }

    public function edit_category_api()
    {
        $id =  request()->id;
        $name =  request()->name;
        $today = date("Y-n-j H:i:s");
        return DB::statement("UPDATE categories SET category_name = '{$name}', updated = '{$today}'  where id = {$id}");
    }

    public function edit_subcategory_api()
    {
        $id =  request()->id;
        $name =  request()->name;
        $today = date("Y-n-j H:i:s");
        return DB::statement("UPDATE sub_categories SET subcategory_name = '{$name}', updated = '{$today}'  where id = {$id}");
    }

    public function del_category_api()
    {
        $id =  request()->id;
        return DB::table('categories')->where('id', '=', $id)->delete();
    }

    public function del_subcategory_api()
    {
        $id =  request()->id;
        return DB::table('sub_categories')->where('id', '=', $id)->delete();
    }
}
