<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class STR extends Model
{
    protected $table = 'str';

    public $timestamps = false;

    protected $fillable = [
        "idpegawai",
        "nomor",
        "nomorrekom",
        "since",
        "expiry",
        "peruntukan",
        "tanggal",
        "idc",
        "idm",
    ];
    
}
