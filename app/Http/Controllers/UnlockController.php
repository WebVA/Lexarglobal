<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use DB;

class UnlockController extends Controller
{
    public function index()
    {
        return view('unlock');
    }

    public function check()
    {
        $pwd =  request()->pwd;
        $adminpwd = DB::table('ph_admin')->select('password')->where('userid', 'admin')->first();
        if ($pwd == $adminpwd->password) {
            session(['is_logged' => true]);
            return redirect()->route('dashboard');
        } else {
            return view('unlock');
        }
    }

    public function logOut()
    {
        session()->forget('is_logged');

        return redirect()->route('first');
    }

    public function change_pwd()
    {
        return view('dashboard.change_pwd');
    }

    public function change_pwd_api()
    {
        $oldpwd =  request()->oldpwd;
        $newpwd =  request()->newpwd;
        $today = date("Y-n-j H:i:s");

        $adminpwd = DB::table('ph_admin')->select('password')->where('userid', 'admin')->first();

        if ($adminpwd->password == $oldpwd) {
            return DB::statement("UPDATE ph_admin SET password = '" . addslashes($newpwd) . "' , modified = '{$today}'  where admin_id = 0");
        } else {
            return 0;
        }
    }
}
