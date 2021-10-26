<?php

namespace App\Http\Controllers;

use App\Models\Po_action;
use DB;

use Illuminate\Http\Request;

class PoActionController extends Controller
{
    public function show_po_actions()
    {
        $po_action = Po_action::all();
        return view('dashboard.po_actions')->with('result', $po_action);
    }

    public function add_po_action()
    {
        return view('dashboard.add_po_action');
    }

    public function add_po_action_api()
    {
        $name =  request()->name;
        $description =  request()->description;
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'action_name' => $name,
            'description' => $description,
            'created' => $today
        ];
        return Po_action::insert($inputs);
    }

    public function edit_po_action($id)
    {
        $po_action =  DB::table('po_actions')->select('id', 'action_name', 'description')->where("id", "=", $id)->get();
        return view('dashboard.edit_po_action')->with('result', $po_action);
    }

    public function edit_po_action_api()
    {
        $id =  request()->id;
        $name =  request()->name;
        $description =  request()->description;
        $today = date("Y-n-j H:i:s");
        return DB::statement("UPDATE po_actions SET action_name = '" . addslashes($name) . "', description = '" . addslashes($description) . "', modified = '{$today}'  where id = {$id}");
    }

    public function del_po_action_api()
    {
        $id =  request()->id;
        return DB::table('po_actions')->where('id', '=', $id)->delete();
    }
}
