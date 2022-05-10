<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\STR;
use App\Pegawai;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $latest = STR::select('idpegawai', DB::raw('max(expiry) as expiry'))
            ->groupBy('idpegawai');

        $str = STR::select('str.id','str.idpegawai','str.expiry', 'str.nomor')
            ->rightJoinSub($latest, 'latest', function($join){
                $join->on('str.idpegawai','=','latest.idpegawai')
                    ->on('str.expiry','=','latest.expiry');
            })
            ->with('pegawai:id,nik,nama')
            ->get();

        return view('dashboard', ['str' => $str]);
    }
}
