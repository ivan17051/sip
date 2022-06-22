<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Profesi;
use App\Spesialisasi;

class ProfesiController extends Controller
{
    public function index(){
        $profesi = Profesi::join('vw_agregatnakesbyprofesi', 'mprofesi.id', '=', 'vw_agregatnakesbyprofesi.idprofesi')->get();
        
        return view('profesi', ['profesi'=>$profesi]);
    }

    public function store(Request $request){
        try{
            $profesi_baru = new Profesi($request->all());
            $profesi_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Profesi Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $profesi = Profesi::findOrFail($id);
            $profesi->fill($request->all());
            $profesi->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Profesi Berhasil Diubah');
        return back();
    }

    public function destroy($id){
        try {
            $profesi = Profesi::findOrFail($id);
            $profesi->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Profesi Berhasil Dihapus');
        return back();
    }

    public function getspesialisasi($id){
        try{
            $data = Spesialisasi::where('idprofesi', $id)->get();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        return $data;
    }

    public function storeSpesialisasi(Request $request){
        try{
            $spesialisasi_baru = new Spesialisasi($request->all());
            $spesialisasi_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Spesialisasi Berhasil Ditambahkan');
        return back();
    }

    public function updateSpesialisasi(Request $request, $id){
        try{
            $spesialisasi = Spesialisasi::findOrFail($id);
            $spesialisasi->fill($request->all());
            $spesialisasi->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Spesialisasi Berhasil Diubah');
        return back();
    }

    public function destroySpesialisasi($id){
        try {
            $spesialisasi = Spesialisasi::findOrFail($id);
            $spesialisasi->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Spesialisasi Berhasil Dihapus');
        return back();
    }
}
