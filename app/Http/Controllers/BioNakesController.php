<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Profesi;
use App\STR;

class BioNakesController extends Controller
{
    public function index(Request $request){
        $idnakes = $request->get('nakes');
        $d['nakes']= isset($idnakes) ? Pegawai::where('id',$idnakes)->first() : null;
        $d['urlparam']=null;

        if(isset($d['nakes'])){
            $d['str']=STR::where('idpegawai', $idnakes)->orderBy('expiry','DESC')->first();
            // $d['sip']=
            $d['urlparam'] ="?nakes={$idnakes}";
            $d['profesi'] = Profesi::all();
        }

        return view('bio', $d);
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
