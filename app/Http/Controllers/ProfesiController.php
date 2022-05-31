<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profesi;

class ProfesiController extends Controller
{
    public function index(){
        $profesi = Profesi::all();
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
            // $profesi->save();
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
        
        $this->flashSuccess('Data Profesi Berhasil Diubah');
        return back();
    }
}
