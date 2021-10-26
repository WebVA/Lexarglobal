<?php

namespace App\Http\Controllers;

use App\Models\Material;
use DB;

use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function show_materials()
    {
        $material = Material::all();
        return view('dashboard.materials')->with('result', $material);
    }

    public function add_material()
    {
        return view('dashboard.add_material');
    }

    public function add_material_api()
    {
        $name =  request()->name;
        $description =  request()->description;
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'name' => $name,
            'description' => $description,
            'created' => $today
        ];
        return Material::insert($inputs);
    }

    public function edit_material($id)
    {
        $material =  DB::table('materials')->select('id', 'name', 'description')->where("id", "=", $id)->get();
        return view('dashboard.edit_material')->with('result', $material);
    }

    public function edit_material_api()
    {
        $id =  request()->id;
        $name =  request()->name;
        $description =  request()->description;
        $today = date("Y-n-j H:i:s");
        return DB::statement("UPDATE materials SET name = '{$name}', description = '{$description}', modified = '{$today}'  where id = {$id}");
    }

    public function del_material_api()
    {
        $id =  request()->id;
        return DB::table('materials')->where('id', '=', $id)->delete();
    }
}
