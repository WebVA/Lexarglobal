<?php

namespace App\Http\Controllers;

use App\Models\Decoration_method;
use DB;

use Illuminate\Http\Request;

class DecorationController extends Controller
{
    public function show_decorations()
    {
        $decoration = Decoration_method::all();
        return view('dashboard.decorations')->with('result', $decoration);
    }

    public function add_decoration()
    {
        return view('dashboard.add_decoration');
    }

    public function add_decoration_api()
    {
        $name =  request()->name;
        $description =  request()->description;
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'name' => $name,
            'description' => $description,
            'created' => $today
        ];
        return Decoration_method::insert($inputs);
    }

    public function edit_decoration($id)
    {
        $decoration =  DB::table('decoration_methods')->select('id', 'name', 'description')->where("id", "=", $id)->get();
        return view('dashboard.edit_decoration')->with('result', $decoration);
    }

    public function edit_decoration_api()
    {
        $id =  request()->id;
        $name =  request()->name;
        $description =  request()->description;
        $today = date("Y-n-j H:i:s");
        return DB::statement("UPDATE decoration_methods SET name = '" . addslashes($name) . "', description = '" . addslashes($description) . "', modified = '{$today}'  where id = {$id}");
    }

    public function del_decoration_api()
    {
        $id =  request()->id;
        return DB::table('decoration_methods')->where('id', '=', $id)->delete();
    }
}
