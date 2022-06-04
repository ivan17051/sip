<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;

class BioNakesController extends Controller
{
    public function index(Request $request){
        $idnakes = $request->get('nakes');
        $nakes= isset($idnakes) ? Pegawai::find($idnakes)->first() : null;

        if(isset($nakes)){
            // $str=
            // $sip=
            $urlparam="?nakes={$idnakes}";
        }

        return view('bio',[
            'nakes'=>$nakes, 
            'urlparam'=>$urlparam,
        ]);
    }

    public function rawBio(Request $request){
        $idnakes = $request->get('nakes');
        $nakes=Pegawai::find($idnakes)->first();
        return view('raw.bio',[
            'nakes'=>$nakes, 
        ]);
    }

    public function rawHistoristr(Request $request){
        $idnakes = $request->get('nakes');
        return view('raw.historistr');
    }

    public function rawHistorisip(Request $request){
        $idnakes = $request->get('nakes');
        return view('raw.historisip');
    }
    
}
