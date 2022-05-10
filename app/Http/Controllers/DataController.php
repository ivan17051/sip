<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use Datatables;

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
                return '<a class="btn btn-sm btn-outline-warning" onclick="edit(this)" data-bs-toggle="modal" data-bs-target="#sunting"><i class="bi bi-pencil-square"></i></a>&nbsp'.
                '<a class="btn btn-sm btn-outline-success" onclick="show(this)"><i class="bi bi-box-arrow-up-right"></i></a>&nbsp'.
                '<a class="btn btn-sm btn-outline-danger" onclick="hapus(this)"><i class="bi bi-trash-fill"></i></a>&nbsp';
            });
        
        return $datatable->make(true); 
    }
    /*
     * Store and update SIP
     */
    public function store(Request $request){
        $input = array_map('trim', $request->all());
        
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:str,id',
        ]);
        
        if ($validator->fails()) return back()->with('error','Gagal memproses');

        try{
            $str = new SIP($input);
            $str->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Berhasil Ditambahkan');
        return back();
    }

    public function destroy($id){
        try {
            $akun = SIP::findOrFail($id);
            $akun->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Berhasil Dihapus');
        return back();
    }
}
