<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Profesi;
use App\STR;
use App\SIP;
use App\Pejabat;
use App\JenisPermohonan;

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
            $d['staf'] = Pejabat::where('jabatan','Staf')->get();
            $d['jenispermohonan'] = JenisPermohonan::where('idprofesi',$d['nakes']->idprofesi)->get();
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
        $str = STR::where('idpegawai', $idnakes)->with('profesi')->orderBy('since', 'desc')
            ->select('idprofesi', 'nomor', 'since', 'expiry')->get();
        
        return view('raw.historistr', ['str'=>$str]);
    }

    public function rawHistorisip(Request $request, $index){
        $idnakes = $request->get('nakes');
        $sip = SIP::where('idpegawai', $idnakes)->where('instance', $index)
            ->orderBy('tglmasukdinas', 'desc')->get();

        return view('raw.historisip', ['sip'=>$sip]);
    }
    
}
