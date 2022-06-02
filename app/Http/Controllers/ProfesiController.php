<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesi;
use App\Spesialisasi;

class ProfesiController extends Controller
{
    public function index(){
        $profesi = Profesi::all();
        return view('profesi', ['profesi'=>$profesi]);
    }

    public function store(Request $request){
        try{
            $profesi_baru = new Profesi($request->all());
            dd($profesi_baru);
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
            dd($profesi);
            $profesi->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Profesi Berhasil Diubah');
        return back();
    }

    public function getspesialisasi($id){
        try{
            $data = Spesialisasi::where('idjenispraktik', $id)->get();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        return $data;
    }
}
