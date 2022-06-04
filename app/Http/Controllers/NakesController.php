<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pegawai;
use Datatables;
use Validator;
use App\Http\Requests\NakesProfileRequest;

class NakesController extends Controller
{
    public function pegawai(){
        return view('nakes');
    }

    public function pegawaiData(Request $request){
        $data = Pegawai::all();
        
        $datatable = Datatables::of($data);
        $datatable->addIndexColumn()
            ->rawColumns(['id','nik','nama','tempatlahir','tanggallahir', 'jeniskelamin', 'alamat', 'nohp', 'action']);
        
        $datatable->addColumn('action', function ($t) { 
                return '<a href="'.route('bio').'?nakes='.$t->id.'" class="btn btn-info btn-link" style="padding:5px;"><i class="material-icons">launch</i></a>&nbsp'.
                '<button type="button" class="btn btn-warning btn-link" style="padding:5px;" onclick="edit(this)"><i class="material-icons">edit</i></button>&nbsp'.
                '<button type="button" class="btn btn-danger btn-link" style="padding:5px;" onclick="hapus(this)"><i class="material-icons">close</i></button>';
            });
        
        return $datatable->make(true); 
    }
    /*
     * Store and update Pegawai
     */
    public function storeUpdatePegawai(NakesProfileRequest $request){
        $input = $request->validated();
        removeNull($input);
        $userId = Auth::id();

        try{
            if(isset($input['id'])){
                $model = Pegawai::firstOrNew([
                    'id' => $input['id']
                ]);
                $model->fill($input);
                $model->idm = $userId;
            }else{
                $model = new Pegawai();
                $model->fill($input);
                $model->idc = $userId;
                $model->idm = $userId;
            }
        }catch(QueryException $exception){
            $this->flashError($exception->getMessage());
            return back();
        }

        $model->save();
        $this->flashSuccess('Data Berhasil Disimpan');
        return back();
    }

    public function deletePegawai($id){
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->delete();
        }catch (QueryException $exception) {
            $this->flashError($exception->getMessage());
            return back();
        }

        $this->flashSuccess('Data Berhasil Dihapus');
        return back();
    }
}
