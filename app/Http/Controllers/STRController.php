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
use \Illuminate\Database\QueryException;
use Exception;

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
