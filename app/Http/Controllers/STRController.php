<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
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
        $input = array_map('trim', $request->all());
        
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:str,id',
        ]);
        
        if ($validator->fails()) return back()->with('error','Gagal memproses');

        try{
            $str = new STR($input);
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
