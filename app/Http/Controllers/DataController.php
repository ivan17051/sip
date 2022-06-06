<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Spesialisasi;
use Datatables;
use Validator;

class DataController extends Controller
{
    public function getSpesialisasi($idprofesi){
        $spesialisasi = Spesialisasi::where('idprofesi',$idprofesi)->get();
        return response()->json($spesialisasi, 200);
    }
}
