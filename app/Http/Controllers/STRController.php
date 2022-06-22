<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\STR;
use App\SIP;
use App\Pegawai;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\Http\Requests\STRRequest;
use \Illuminate\Database\QueryException;
use Exception;

class STRController extends Controller
{
    public function index(){
        return view('str');
    }

    public function data(Request $request){

        $subquery = Pegawai::select('mpegawai.id','nik','nama','sip.expirystr','str.nomor as nomorstr','sip.nomor as nomorsip', DB::raw('@expirydiff := DATEDIFF(expiry, current_date) as expirydiff'),
            DB::raw("IF(sip.nomor IS NULL, -2, IF(@expirydiff<0, -1, IF(@expirydiff<60, 0, 1)) )  as validstatus")
        )
            ->leftJoin('str', function($q){
                $q->on('str.idpegawai','=','mpegawai.id')->where('str.isactive', 1);
            })
            ->leftJoin('sip', function($join){
                $latestsip = SIP::select(DB::raw('max(id) as maxid'))->where('isactive', 1)->whereColumn('idpegawai', 'mpegawai.id');
                $join->on('sip.idstr','=', 'str.id')
                    ->whereRaw("sip.id = ({$latestsip->toSql()})")
                    ->mergeBindings($latestsip->getQuery());
            });
        
        $data = DB::table( DB::raw("({$subquery->toSql()}) as sub") )
            ->mergeBindings($subquery->getQuery());

        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }

    public function show($id){
        $pegawai = Pegawai::findOrFail($id);
        $str = STR::where('idpegawai', $id)->get();
        return view('str', ['pegawai'=>$pegawai, 'str'=>$str]);
    }

    /*
     * Store STR
     */
    public function store(STRRequest $request){
        $userId = Auth::id();
        $input = $request->validated();
        
        DB::beginTransaction();
        try{
            $nakes = Pegawai::findOrFail($input['idpegawai']);

            $current = STR::where( 'idpegawai', $nakes->id )
                        ->orderBy('id','DESC')->first();
            
            if($current){
                $current->isactive = false;
                $current->save();
            }

            // JIKA PERPANJANG SIP SEKALIAN
            // if(isset($input['isperpanjangsip']) AND $input['isperpanjangsip']){

            // }

            $model = new STR();
            $model->fill($input);
            $model->fill([
                'nomorregis' => $nakes->nomorregis,
                'idprofesi' => $nakes->idprofesi,
                'idspesialisasi' => $nakes->idspesialisasi,
            ]);
            $model->idc = $userId;
            $model->idm = $userId;
            $model->save();
            DB::commit();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
        }catch(Exception $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }

    /*
     * Update STR
     */
    public function update(STRRequest $request){
        $userId = Auth::id();
        $input = $request->validated();

        DB::beginTransaction();
        try{
            $model = STR::findOrFail($input['id']);
            $model->fill($input);
            $model->idc = $userId;
            $model->idm = $userId;
            $model->save();
            DB::commit();
            return response()->json(['message'=>'Berhasil Memperbarui Data'], 200);
        }catch(Exception $exception){
            DB::rollBack();
            return response()->json($exception->getMessage(), 200);
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            $akun = STR::findOrFail($id);
            if(!$akun->isactive) throw new Exception("Unauthorized");

            $akun->isactive = 0;
            $akun->save();
            DB::commit();
            $this->flashSuccess('STR Berhasil Dinonaktifkan');
            return back();
        }catch (Exception $exception) {
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }
}
