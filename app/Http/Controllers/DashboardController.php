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
        return view('dashboard');
    }

    public function data(Request $request){
        $latest = STR::select('idpegawai', DB::raw('max(expiry) as expiry'))
            ->groupBy('idpegawai');

        $data = STR::select('str.id','str.idpegawai','str.expiry', 'str.nomor')
            ->rightJoinSub($latest, 'latest', function($join){
                $join->on('str.idpegawai','=','latest.idpegawai')
                    ->on('str.expiry','=','latest.expiry');
            })
            ->with('pegawai:id,nik,nama');
        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }
}
