<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pegawai;
use App\Profesi;
use Datatables;
use Validator;
use App\Http\Requests\NakesProfileRequest;

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
     * Store and update Pegawai
     */
    public function storeUpdatePegawai(NakesProfileRequest $request){
        $input = $request->validated();
        removeNull($input);
        $userId = Auth::id();

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
                $spesialisasi = Profesi::find($input['idspesialisasi']);
                $profesiinfo = [
                    'kodeprofesi' => $profesi->kode,
                    'profesi' => $profesi->nama,
                    'idspesialisasi' => $spesialisasi->id,
                    'spesialisasi' => $spesialisasi->nama,
                ];
            }            
            
            if(isset($input['id']) ){
                $model = Pegawai::find([$input['id'],$input['kodeprofesi']]);
                if(!isset($model)) throw new Exception("Nakes tidak ditemukan");
                $model->fill($input);
                $model->fill($profesiinfo);
                $model->idm = $userId;
            }else{
                $model = new Pegawai();
                $model->fill($input);
                $model->fill($profesiinfo);
                $model->idc = $userId;
                $model->idm = $userId;
            }
            $model->save();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
            
        }catch (Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 400);
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
