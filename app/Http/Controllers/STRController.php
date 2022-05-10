<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\STR;

class STRController extends Controller
{
    public function index(){
        
        return view('str');
    }

    /*
     * Store and update STR
     */
    public function store(Request $request){
        try{
            $str = new STR($request->all());
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
