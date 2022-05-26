<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SIP extends Model
{
    protected $table = 'sip';

    public $timestamps = false;

    protected $fillable = [
        "idstr",
        "idpegawai",
        "nomorstr",
        "expirystr",
        "nomor",
        "since",
        "ended",
        "idc",
        "idm",
        "isactive",
        "idfaskes",
        "namafaskes",
        "alamatfaskes",
    ];
    
}
