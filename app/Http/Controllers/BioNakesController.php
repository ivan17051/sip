<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Profesi;
use App\STR;
use App\SIP;
use App\Pejabat;
use App\JenisPermohonan;
use App\Faskes;

class BioNakesController extends Controller
{
    public function index(Request $request){
        $idstrlawas = $request->get('idstrlawas');

        $idnakes = $request->get('nakes');
        $d['nakes']= isset($idnakes) ? Pegawai::where('id',$idnakes)->with('profesirelation')->first() : null;
        $d['urlparam']=null;
        $d['makssip']=0;
        $d['puskesmas']=Faskes::where('nama','LIKE','Puskesmas%')->get();

        if(isset($d['nakes'])){
            $d['makssip']=$d['nakes']->profesirelation->makssip;

            if(isset($idstrlawas)){
                $d['str']=STR::where('idpegawai', $idnakes)->where('id', $idstrlawas)->first();
            }else{
                $d['str']=STR::where('idpegawai', $idnakes)->orderBy('id','DESC')->first();
            }
            $d['urlparam'] ="?nakes={$idnakes}";
            $d['profesi'] = Profesi::all();
            $d['staf'] = Pejabat::where('jabatan','Staf')->get();
            $d['jenispermohonan'] = JenisPermohonan::where('idprofesi',$d['nakes']->idprofesi)->get();
        }
        
        if (isset($d['str'])) {
            for($i=0;$i<$d['makssip'];$i++){
                $d['sips'][$i]=SIP::where('idstr', $d['str']->id)->where('instance',$i+1)->orderBy('iterator', 'desc')->first();
            }
            // $d['sips']=SIP::where('idstr', $d['str']->id)->where('isactive',1)->orderBy('instance')->get()->toArray();
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
        $idstr = $request->get('idstr');
        $str = STR::where('idpegawai', $idnakes)->with('profesi')->orderBy('id', 'desc')
            ->select('id','idprofesi', 'nomor', 'since', 'expiry')->get();        
        // SELECTED ID STR YANG DITAMPILKAN PADA HISTORI
        if(!isset($idstr) AND $str->isNotEmpty()) $idstr=$str[0]->id;
        $urlparam ="?nakes={$idnakes}";
        return view('raw.historistr', ['str'=>$str, 'idstr'=>$idstr, 'urlparam'=>$urlparam]);
    }

    public function rawHistorisip(Request $request, $index){
        $idnakes = $request->get('nakes');
        $idstr = $request->get('idstr');
        $sip = SIP::where('idpegawai', $idnakes)->where('instance', $index)
            // ->where('idstr',$idstr)
            ->orderBy('id', 'desc')->get();

        return view('raw.historisip', ['sip'=>$sip]);
    }
    
}
