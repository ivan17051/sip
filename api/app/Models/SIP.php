<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class STR extends Model
{
    protected $table = 'str';

    public $timestamps = false;

    protected $fillable = [
        "idstr",
        "idpegawai",
        "nomorstr",
        "expirystr",
        "nomor",
        "saranapraktik",
        "alamatpraktik",
        "since",
        "ended",
        "idc",
        "idm",
    ];
    
}
