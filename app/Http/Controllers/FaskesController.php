<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Faskes;
use App\SIP;
use App\Kategori;

class FaskesController extends Controller
{
    public function index(){
        return view('faskes');
    }

    public function data(){
        $data = Faskes::with('kategori');
        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }

    public function getpegawai($idfaskes){
        
        $datapegawai = SIP::where('idfaskes', $idfaskes)->with('pegawai');
        $datatable = Datatables::of($datapegawai);
        $datatable->addColumn('action', function ($t) { 
            return '<a href="'.route('bio').'?nakes='.$t->id.'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i></a>&nbsp';
        });
        return $datatable->addIndexColumn()->make(true);
    }

    public function store(){
        
    }

    public function update(Request $request, $faskes){
        
    }

    public function destroy(Request $request, $faskes){
        
    }
}
