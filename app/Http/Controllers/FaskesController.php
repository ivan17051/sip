<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Faskes;
use App\SIP;
use App\Kategori;

class FaskesController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        return view('faskes', ['kategori'=>$kategori]);
    }

    public function data(){
        $data = Faskes::with('kategori');
        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }

    public function getpegawai($idfaskes){
        
        $datapegawai = SIP::where('idfaskes', $idfaskes)->where('isactive', 1)->with('pegawai');
        $datatable = Datatables::of($datapegawai);
        $datatable->addColumn('action', function ($t) { 
            return '<a href="'.route('bio').'?nakes='.$t->id.'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i></a>&nbsp';
        });
        return $datatable->addIndexColumn()->make(true);
    }

    public function store(Request $request){
        try{
            $faskes_baru = new Faskes($request->all());
            $faskes_baru->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Faskes Berhasil Ditambahkan');
        return back();
    }

    public function update(Request $request, $id){
        try{
            $faskes = Faskes::findOrFail($id);
            $faskes->fill($request->all());
            $faskes->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Faskes Berhasil Diubah');
        return back();
    }

    public function destroy(Request $request, $id){
        try {
            $faskes = Faskes::findOrFail($id);
            $faskes->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Faskes Berhasil Dihapus');
        return back();
    }
}
