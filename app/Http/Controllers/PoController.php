<?php

namespace App\Http\Controllers;

use App\Models\Po_action;
use App\Models\Po_list;
use App\Mail\PoMail;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PoController extends Controller
{
    public function create_po()
    {
        $Po_action = Po_action::all();
        return view("dashboard.add_po")->with("po_action", $Po_action);
    }

    public function add_po_api()
    {
        $po_number = request()->po_number;
        $company_name = request()->company_name;
        $po_date = request()->po_date;
        $last_action = request()->last_action;
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'po_number' => $po_number,
            'company_name' => $company_name,
            'po_date' => $po_date,
            'last_action' => $last_action,
            'created' => $today
        ];
        return Po_list::insert($inputs);
    }

    public function search_po()
    {
        $company_name = Po_list::distinct()->get('company_name');
        return view("dashboard.search_po")->with("no_result", 1)->with("company_name", $company_name);
    }

    public function search_result()
    {
        $po_action = Po_action::all();
        $po_number = request()->po_number;
        $company_name = request()->company_name;
        $po_date = request()->po_date;
        $query = "SELECT e.*,f.origin_date
        FROM
        (SELECT c.*,d.action_name FROM
        (SELECT b.*
        FROM 
        (SELECT MAX(id) AS max_id FROM po_lists GROUP BY po_number)a
        LEFT JOIN po_lists b ON a.max_id = b.id)c, po_actions d
        WHERE c.last_action = d.id)e, 
        (SELECT t2.po_date AS origin_date,t2.po_number
        FROM
        (SELECT MIN(id) AS min_id FROM po_lists GROUP BY po_number)t1
        LEFT JOIN po_lists t2 ON t1.min_id = t2.id)f
        WHERE e.po_number = f.po_number";
        if ($po_date || $po_number || $company_name) {
            if ($po_number) {
                $query .= " AND";
                $query .= " e.po_number ='" . addslashes($po_number) . "'";
            }

            if ($po_date) {
                $query .= " AND";
                $query .= " e.po_date = '{$po_date}'";
            }

            if ($company_name) {
                $query .= " AND";
                $query .= " e.company_name ='" . addslashes($company_name) . "'";
            }
        }
        $po_lists = DB::select(DB::raw($query));
        return view("dashboard.report_po")->with("result", $po_lists);
    }

    public function edit_po($po_number, $company_name)
    {
        $po_action = Po_action::all();
        $po_lists = DB::table('po_lists')
            ->where('po_number', '=', $po_number)
            ->where('company_name', '=', $company_name)
            ->get();
        $action_lists = DB::select(DB::raw("SELECT a.*,po_actions.action_name
                                            FROM
                                            (SELECT * FROM po_lists WHERE po_number='" . addslashes($po_number) . "'  AND company_name='" . addslashes($company_name) . "' ORDER BY created)a
                                            LEFT JOIN po_actions ON po_actions.id=a.last_action"));
        if (count($po_lists)) {
            return view("dashboard.search_result")->with("po_action", $po_action)->with("po_lists", $po_lists)->with("action_lists", $action_lists);
        } else {
            return view("dashboard.search_po")->with("no_result", 1);
        }
    }

    public function add_action_api()
    {
        $po_number = request()->po_number;
        $company_name = request()->company_name;
        $po_date = request()->po_date;
        $last_action = request()->last_action;
        $today = date("Y-n-j H:i:s");
        $inputs = [
            'po_number' => $po_number,
            'company_name' => $company_name,
            'po_date' => $po_date,
            'last_action' => $last_action,
            'created' => $today
        ];
        return Po_list::insert($inputs);
    }

    public function edit_action_api()
    {
        $id =  request()->id;
        $po_date =  request()->po_date;
        $last_action =  request()->last_action;
        $today = date("Y-n-j H:i:s");
        return DB::statement("UPDATE po_lists SET po_date = '{$po_date}', last_action = '{$last_action}', modified = '{$today}'  where id = {$id}");
    }

    public function del_action_api()
    {
        $id =  request()->id;
        return DB::table('po_lists')->where('id', '=', $id)->delete();
    }

    public function del_po_api()
    {
        $id =  request()->id;
        return DB::table('po_lists')->where('company_name', '=', $id)->delete();
    }

    public function report_po()
    {
        $result = DB::select(DB::raw("SELECT e.*,f.origin_date
        FROM
        (SELECT c.*,d.action_name FROM
        (SELECT b.*
        FROM 
        (SELECT MAX(id) AS max_id FROM po_lists GROUP BY po_number)a
        LEFT JOIN po_lists b ON a.max_id = b.id)c, po_actions d
        WHERE c.last_action = d.id)e, 
        (SELECT t2.po_date AS origin_date,t2.po_number
        FROM
        (SELECT MIN(id) AS min_id FROM po_lists GROUP BY po_number)t1
        LEFT JOIN po_lists t2 ON t1.min_id = t2.id)f
        WHERE e.po_number = f.po_number"));
        return view("dashboard.report_po")->with("result", $result);
    }

    public function send_email()
    {
        $recipients =  request()->recipients;
        $subject =  request()->subject;
        $content =  request()->content;
        $maildata = [];
        $maildata['subject'] = $subject;
        $maildata['content'] = $content;
        // return $maildata;
        Mail::to($recipients)->send(new PoMail($maildata));
    }
}
