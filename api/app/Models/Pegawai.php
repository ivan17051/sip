<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'mpegawai';

    public $timestamps = false;

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
    ];
    
}
