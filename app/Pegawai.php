<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'mpegawai';

    public $timestamps = false;

    protected $casts = [
        'tanggallahir' => 'date',
    ];

    protected $fillable = [
        "nik",
        "nama",
        "tempatlahir",
        "tanggallahir",
        "jeniskelamin",
        "alamat",
        "nohp",
        "idc",
        "idm",
        "provinsi",
        "kabkota",
        "kecamatan",
        "kelurahan",
        "perguruantinggi",
        "tahunlulus",
        "idprofesi",
        "idspesialisasi",
        "profesi",
        "spesialisasi",
        "foto",
    ];
    
    public function profesiTable(){
        return $this->belongsTo(Profesi::class, 'idprofesi');
    }

    public function spesialisasiTable(){
        return $this->belongsTo(Spesialisasi::class, 'idspesialisasi');
    }
}
