<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\STR;
use App\Pegawai;
use Illuminate\Support\Facades\DB;
use Datatables;

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
    public function store(Request $request){
        $userId = Auth::id();
        $input = array_map('trim', $request->all());
        
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:str,id',
        ]);
        
        if ($validator->fails()) return back()->with('error','Gagal memproses');
        
        try{
            if(isset($input['id'])){
                $model = STR::firstOrNew([
                    'id' => $input['id']
                ]);
                $model->fill($input);
                $model->idm = $userId;
            }else{
                $model = new STR();
                $model->fill($input);
                $model->idc = $userId;
                $model->idm = $userId;
            }
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $model->save();
        $this->flashSuccess('Data Berhasil Disimpan');
        return back();
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
