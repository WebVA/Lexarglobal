<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Po_action;
use App\Models\Po_list;
use DB;
use Illuminate\Http\Request;

class UTrackorderController extends Controller
{
    public function index()
    {
        $brand = Brand::where('status', 1)->limit(30)->get();
        return view('user.track')->with("brand", $brand);
    }

    public function search_po_api(Request $request)
    {
        $po_action = Po_action::all();
        $po_number = request()->num;
        $po_date = request()->date;
        $returndata = [];

        $initdate = DB::select(DB::raw("SELECT po_date,company_name FROM po_lists WHERE id IN (SELECT MIN(id) FROM po_lists WHERE po_number='" . addslashes($po_number) . "')"));
        if ($initdate[0]->po_date == $po_date) {
            $action_lists = DB::select(DB::raw("SELECT a.*,po_actions.action_name
                                                FROM
                                                (SELECT * FROM po_lists WHERE po_number='" . addslashes($po_number) . "' ORDER BY created)a
                                                LEFT JOIN po_actions ON po_actions.id=a.last_action"));
            $returndata['company'] = $initdate[0]->company_name;
            $returndata['action_lists'] = $action_lists;
            return json_encode($returndata);
        } else {
            return null;
        }
    }
}
