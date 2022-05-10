<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\SIP;
use App\STR;

class SIPController extends Controller
{
    public function show($id_str){
        try {
            $str =  STR::select('str.id','str.idpegawai','str.expiry', 'str.nomor')
                ->with('pegawai:id,nik,nama')
                ->find($id_str);
            $sip = SIP::select('id','idpegawai','nomor', 'saranapraktik', 'alamatpraktik', 'since', 'ended')
                ->where('idstr',$id_str)->get();
        } catch (\Throwable $th) {
            return redirect('/');
        }
        return view('sip', ['str'=>$str, 'sip'=>$sip]);
    }

    /*
     * Store and update SIP
     */
    public function store(Request $request){
        $user = Auth::user();
        $input = array_map('trim', $request->all());
        
        $validator = Validator::make($input, [
            'id' => 'nullable|exists:sip,id',
        ]);
        
        if ($validator->fails()){ 
            $this->flashError('Gagal memproses');
            return back()->with('error','Gagal memproses');
        }

        try{
            if(isset($input['id'])){
                $sip = SIP::find($input['id']);
                $sip->fill($input);
                $sip->fill([
                    'idm'=> $user->id,
                ]);
                $sip->save();
                $this->flashSuccess('Data Berhasil Diperbarui');
                return back();
            }else{
                $str = STR::select('id','nomor','expiry','idpegawai')->find($input['idstr']);
                $sip = new SIP($input);
                $sip->fill([
                    'idstr' => $str['id'],
                    'idpegawai' => $str['idpegawai'],
                    'nomorstr' => $str['nomor'],
                    'expirystr' => $str['expiry'],
                    'idc'=> $user->id,
                    'idm'=> $user->id,
                ]);
                $sip->save();
                $this->flashSuccess('Data Berhasil Ditambahkan');
                return back();
            }
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }
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
