<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use Traits\HasCompositePrimaryKey;
    
    protected $table = 'mpegawai';

    public $timestamps = false;

    protected $casts = [
        'tanggallahir' => 'date',
    ];

    protected $primaryKey = ['id', 'kodeprofesi'];
    public $incrementing = false;

    protected $fillable = [
        "id",
        "kodeprofesi",
        "nik",
        "nama",
        "tempatlahir",
        "tanggallahir",
        "jeniskelamin",
        "alamatktp",
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
