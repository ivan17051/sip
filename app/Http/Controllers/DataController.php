<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pegawai;
use Datatables;
use Validator;

class DataController extends Controller
{
    public function pegawai(){
        return view('pegawai');
    }

    public function pegawaiData(Request $request){
        $data = Pegawai::all();
        
        $datatable = Datatables::of($data);
        $datatable->addIndexColumn()
            ->rawColumns(['id','nik','nama','tempatlahir','tanggallahir', 'jeniskelamin', 'alamat', 'nohp', 'action']);
        
        $datatable->addColumn('action', function ($t) { 
                return '<button class="btn btn-info btn-link" style="padding:5px;" onclick="show(this)"><i class="material-icons">launch</i></button>&nbsp'.
                '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp'.
                '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">delete</i></button>';
            });
        
        return $datatable->make(true); 
    }
    /*
     * Store and update Pegawai
     */
    public function storeUpdatePegawai(Request $request){
        $userId = Auth::id();
        $input = array_map('trim', $request->all());
        
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:str,id',
            'nik' => 'string',
            'nama' => 'required|string',
            'tempatlahir' => 'required|string',
            'tanggallahir' => 'required|string',
            'jeniskelamin' => 'required|string',
            'alamat' => 'string',
            'nohp' => 'string',
        ]);
        
        if ($validator->fails()) return back()->with('error','Data Gagal Diproses');
        try{
            if(isset($input['id'])){
                $model = Pegawai::firstOrNew([
                    'id' => $input['id']
                ]);
                $model->fill($input);
                $model->idm = $userId;
            }else{
                $model = new Pegawai();
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
