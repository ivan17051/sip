<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\STR;
use App\Pegawai;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\Http\Requests\STRRequest;

class STRController extends Controller
{
    public function index(){
        return view('str');
    }

    public function data(Request $request){
        $latest = STR::select('idpegawai', DB::raw('max(expiry) as expiry'))
            ->groupBy('idpegawai');

        $data = STR::select('str.id','str.idpegawai','str.expiry', 'str.nomor')
            ->rightJoinSub($latest, 'latest', function($join){
                $join->on('str.idpegawai','=','latest.idpegawai')
                    ->on('str.expiry','=','latest.expiry');
            })
            ->with('pegawai:id,nik,nama');
        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }

    public function show($id){
        $pegawai = Pegawai::findOrFail($id);
        $str = STR::where('idpegawai', $id)->get();
        return view('str', ['pegawai'=>$pegawai, 'str'=>$str]);
    }

    /*
     * Store and update STR
     */
    public function store(STRRequest $request){
        $userId = Auth::id();
        $input = $request->validated();
        
        try{
            DB::beginTransaction();
            $inputProfesiSpesialisasi = collect($input)->only("idprofesi", "idspesialisasi")->toArray();
            $pegawai = Pegawai::where('id',$input['idpegawai'])->select('id')->first();
            $pegawai->fill($inputProfesiSpesialisasi);
            $pegawai->save();

            $model = new STR();
            $model->fill($input);
            $model->idc = $userId;
            $model->idm = $userId;
            $model->save();
            DB::commit();
            $this->flashSuccess('Data Berhasil Disimpan');
            return back();
        }catch(QueryException $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }

    public function destroy($id){
        try {
            $akun = STR::findOrFail($id);
            $akun->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Berhasil Dihapus');
        return back();
    }
}
