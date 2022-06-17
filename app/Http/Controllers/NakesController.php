<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Profesi;
use App\Spesialisasi;
use Datatables;
use Validator;
use App\Http\Requests\NakesProfileRequest;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;
use Exception;

class NakesController extends Controller
{
    public function pegawai(){
        $d['profesi'] = Profesi::all();
        return view('nakes', $d);
    }

    public function pegawaiData(Request $request){
        $data = Pegawai::all();
        
        $datatable = Datatables::of($data);
        $datatable->addIndexColumn()
            ->rawColumns(['id','nik','nama','tempatlahir','tanggallahir', 'jeniskelamin', 'alamat', 'nohp', 'action']);
        
        $datatable->addColumn('action', function ($t) { 
                return '<a href="'.route('bio').'?nakes='.$t->id.'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i></a>&nbsp'.
                '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp'.
                '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">close</i></button>';
            });
        
        return $datatable->make(true); 
    }
    /*
     * Store Pegawai
     */
    public function storePegawai(NakesProfileRequest $request){
        $input = $request->validated();
        removeNull($input);
        $userId = Auth::id();

        DB::beginTransaction();
        try{
            $profesi = Profesi::find($input['idprofesi']);
            if(!$profesi->isparent){
                $profesiinfo = [
                    'kodeprofesi' => $profesi->kode,
                    'profesi' => $profesi->nama,
                    'idspesialisasi' => NULL,
                    'spesialisasi' => NULL,
                ];
            }else{
                $spesialisasi = Spesialisasi::find($input['idspesialisasi']);
                $profesiinfo = [
                    'kodeprofesi' => $profesi->kode,
                    'profesi' => $profesi->nama,
                    'idspesialisasi' => $spesialisasi->id,
                    'spesialisasi' => $spesialisasi->nama,
                ];
            }            

            if(!isset($input['nomorregis'])){
                $input['nomorregis'] = NULL;        //will automatically set by trigger
            }
        
            $model = new Pegawai();
            $model->fill($input);
            $model->fill($profesiinfo);
            $model->idc = $userId;
            $model->idm = $userId;
            $model->save();
            DB::commit();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
        }catch (Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 400);
        }
    }

    /*
     * Update Pegawai
     */
    public function updatePegawai(NakesProfileRequest $request){
        $input = $request->validated();
        removeNull($input);
        $userId = Auth::id();

        DB::beginTransaction();
        try{
            $profesi = Profesi::find($input['idprofesi']);
            if(!$profesi->isparent){
                $profesiinfo = [
                    'kodeprofesi' => $profesi->kode,
                    'profesi' => $profesi->nama,
                    'idspesialisasi' => NULL,
                    'spesialisasi' => NULL,
                ];
            }else{
                $spesialisasi = Spesialisasi::find($input['idspesialisasi']);
                $profesiinfo = [
                    'kodeprofesi' => $profesi->kode,
                    'profesi' => $profesi->nama,
                    'idspesialisasi' => $spesialisasi->id,
                    'spesialisasi' => $spesialisasi->nama,
                ];
            }            

            $model = Pegawai::findOrFail($input['id']);
            
            // jika ganti profesi, mengganti nomorregis juga ke MAX
            if( $model->idprofesi <> $input['idprofesi']){
                $idmax = Pegawai::select( DB::raw("coalesce(MAX(nomorregis)+1 , 1) idmax"))->where('idprofesi',$input['idprofesi'])->pluck('idmax')->first();

                $input['nomorregis'] = $idmax;
            }
        
            $model->fill($input);
            $model->fill($profesiinfo);
            $model->idm = $userId;    
            
            $model->save();
            DB::commit();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
        }catch (Exception $e) {
            DB::rollback();
            if(isset($e->errorInfo) AND $e->errorInfo[0] == 23000){
                $this->flashError("Nomor regis {$model['nomorregis']} sudah terpakai");    
            }else{
                $this->flashError($e->getMessage());
            }
            return back();
        }
    }

    public function deletePegawai($id){
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Berhasil Dihapus');
        return back();
    }
}
