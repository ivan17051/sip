<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Spesialisasi;
use App\Pegawai;
use App\Faskes;
use Datatables;
use Validator;

class DataController extends Controller
{
    public function getSpesialisasi($idprofesi){
        $spesialisasi = Spesialisasi::where('idprofesi',$idprofesi)->get();
        return response()->json($spesialisasi, 200);
    }

    public function searchFaskes(Request $request){
        $data=$request->input('query');
        $data = Faskes::where('nama', 'like', '%' . strtolower($request->input('query')) . '%')
            ->limit(5)
            ->get();
        return response()->json($data, 200);
    }

    public function searchPegawai(Request $request){
        $data=$request->input('query');
        $data = Pegawai::where('nama', 'like', '%' . strtolower($request->input('query')) . '%')
            ->orWhere('nip', 'like', '%' . strtolower($request->input('query')) . '%')
            ->limit(5)
            ->get();
        return response()->json($data);
    }
}
