<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Profesi;
use App\STR;
use App\SIP;

class BioNakesController extends Controller
{
    public function index(Request $request){
        $idnakes = $request->get('nakes');
        $d['nakes']= isset($idnakes) ? Pegawai::where('id',$idnakes)->first() : null;
        $d['urlparam']=null;

        if(isset($d['nakes'])){
            $d['str']=STR::where('idpegawai', $idnakes)->orderBy('id','DESC')->first();
            $d['urlparam'] ="?nakes={$idnakes}";
            $d['profesi'] = Profesi::all();
        }
        
        if (isset($d['str'])) {
            $d['sips']=SIP::where('idstr', $d['str']->id)->where('isactive',1)->get()->toArray();
        }else{
            $d['sips'] = [];
        }

        return view('bio', $d);
    }

    public function rawBio(Request $request){
        $idnakes = $request->get('nakes');
        $d['nakes']=Pegawai::find($idnakes);
        $d['str']=STR::where('idpegawai', $idnakes)->orderBy('id','DESC')->first();
        return view('raw.bio', $d);
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