<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SIP;

class SIPController extends Controller
{
    public function index(){
        
        return view('sip');
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
