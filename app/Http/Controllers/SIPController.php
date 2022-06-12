<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\SIP;
use App\STR;
use App\Http\Requests\SIPRequest;

class SIPController extends Controller
{
    public function show($id_str){
        try {
            $str =  STR::select('str.id','str.idpegawai','str.expiry', 'str.nomor')
                ->with('pegawai:id,nik,nama')
                ->find($id_str);
            $sip = SIP::select('id','idpegawai','nomor', 'namafaskes', 'alamatfaskes', 'since', 'ended')
                ->where('idstr',$id_str)->get();
        } catch (\Throwable $th) {
            return redirect('/');
        }
        return view('sip', ['str'=>$str, 'sip'=>$sip]);
    }

    /*
     * Store SIP
     */
    public function store(SIPRequest $request){
        $userId = Auth::id();
        $input = $request->validated();
        
        try{
            DB::beginTransaction();
            
            $str = STR::select('id','nomor','expiry','idpegawai')->find($input['idstr']);
            $latestsip = SIP::where('idstr', $input['idstr'])->where('instance', $input['instance'])->max('iterator');
            $sip = new SIP($input);
            $sip->fill([
                'iterator' => isset($latestsip) ? $latestsip+1 : 1,
                'idpegawai' => $str['idpegawai'],
                'nomorstr' => $str['nomor'],
                'expirystr' => $str['expiry'],
                'idc'=> $userId,
                'idm'=> $userId,
            ]);
            $sip->save();
            DB::commit();
            $this->flashSuccess('Data Berhasil Ditambahkan');
            return back();
        }catch(QueryException $exception){
            DB::rollBack();
            $this->flashError($exception->getMessage());
            return back();
        }
    }

    /*
     * update SIP
     */
    public function update(SIPRequest $request){
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
