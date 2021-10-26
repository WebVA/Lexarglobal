<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use DB;
use Illuminate\Http\Request;
use Validator;

class BlandController extends Controller
{
    public function show_blands()
    {
        $bland = Brand::all();
        return view('dashboard.blands')->with('result', $bland);
    }

    public function add_bland()
    {
        return view('dashboard.add_bland');
    }

    public function add_bland_api(Request $request)
    {
        if ($request->file('brand_image')) {
            $validation = Validator::make($request->all(), [
                'brand_image' => 'image|mimes:jpeg,png,jpg,gif|max:10000'
            ]);
            if ($validation->passes()) {
                $image = $request->file('brand_image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/brand_images'), $new_name);
                $name =  $request->input('brand_name');
                $status =  $request->input('brand_status');
                $description =  $request->input('brand_description');
                $today = date("Y-n-j H:i:s");
                $inputs = [
                    'brand_name' => addslashes($name),
                    'status' => $status,
                    'description' => addslashes($description),
                    'brand_image' => $new_name,
                    'created' => $today
                ];
                $result = Brand::insert($inputs);
                if ($result) {
                    return response()->json([
                        'message'   => 'success',
                        'uploaded_image' => '<img src="/upload/brand_images' . $new_name . '" class="img-thumbnail" width="300"/>',
                    ]);
                } else {
                    return response()->json([
                        'message'   => 'db error',
                        'uploaded_image' => '<img src=""/>',
                    ]);
                }
            } else {
                return response()->json([
                    'message'   => $validation->errors()->all(),
                    'uploaded_image' => '<img src=""/>',
                ]);
            }
        } else {
            $name =  $request->input('brand_name');
            $status =  $request->input('brand_status');
            $description =  $request->input('brand_description');
            $today = date("Y-n-j H:i:s");
            $inputs = [
                'brand_name' => addslashes($name),
                'status' => $status,
                'description' => addslashes($description),
                'created' => $today
            ];
            $result = Brand::insert($inputs);
            if ($result) {
                return response()->json([
                    'message'   => 'success',
                    'uploaded_image' => '<img src=""/>',
                ]);
            } else {
                return response()->json([
                    'message'   => 'db error',
                    'uploaded_image' => '<img src=""/>',
                ]);
            }
        }
    }

    public function edit_bland($id)
    {
        $brand =  DB::table('brands')->select('*')->where("id", "=", $id)->get();
        return view('dashboard.edit_bland')->with('result', $brand);
    }

    public function edit_bland_api(Request $request)
    {
        if ($request->file('brand_image')) {
            $validation = Validator::make($request->all(), [
                'brand_image' => 'image|mimes:jpeg,png,jpg,gif|max:10000'
            ]);
            if ($validation->passes()) {
                $image = $request->file('brand_image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/brand_images'), $new_name);
                $id =  $request->input('brand_id');
                $name =  $request->input('brand_name');
                $status =  $request->input('brand_status');
                $description =  $request->input('brand_description');
                $today = date("Y-n-j H:i:s");
                $result = DB::statement("UPDATE brands SET brand_name = '" . addslashes($name) . "', description = '" . addslashes($description) . "', status = '{$status}' , modified = '{$today}', brand_image = '{$new_name}' where id = {$id}");
                if ($result) {
                    return response()->json([
                        'message'   => 'success1',
                        'uploaded_image' => '<img src="/upload/brand_images' . $new_name . '" class="img-thumbnail" width="300"/>',
                    ]);
                } else {
                    return response()->json([
                        'message'   => 'db error',
                        'uploaded_image' => '<img src=""/>',
                    ]);
                }
            } else {
                return response()->json([
                    'message'   => $validation->errors()->all(),
                    'uploaded_image' => '<img src=""/>',
                ]);
            }
        } else {
            $id =  $request->input('brand_id');
            $name =  $request->input('brand_name');
            $status =  $request->input('brand_status');
            $description =  $request->input('brand_description');
            $today = date("Y-n-j H:i:s");
            $result = DB::statement("UPDATE brands SET brand_name = '" . addslashes($name) . "', description = '" . addslashes($description) . "', status = '{$status}' , modified = '{$today}' where id = {$id}");
            if ($result) {
                return response()->json([
                    'message'   => 'success2',
                    'uploaded_image' => '<img src=""/>',
                ]);
            } else {
                return response()->json([
                    'message'   => 'db error',
                    'uploaded_image' => '<img src=""/>',
                ]);
            }
        }
    }

    public function del_bland_api()
    {
        $id =  request()->id;
        return DB::table('brands')->where('id', '=', $id)->delete();
    }
}
