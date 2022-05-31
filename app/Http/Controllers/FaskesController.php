<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Faskes;
use App\Kategori;

class FaskesController extends Controller
{
    public function index(){
        return view('faskes');
    }

    public function data(){
        $data = Faskes::with('kategori');
        $datatable = Datatables::of($data);
        return $datatable->addIndexColumn()->make(true);
    }

    public function store(){
        
    }

    public function update(Request $request, $faskes){
        
    }

    public function destroy(Request $request, $faskes){
        
    }
}
