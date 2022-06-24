<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\STR;
use App\Pegawai;
use Illuminate\Support\Facades\DB;
use Datatables;

class DashboardController extends Controller
{
    public function index(){
        $d['stats'] = DB::table('vw_agregatnakesbystatussip')->get()->keyBy('status');
        return view('dashboard', $d);
    }
}
