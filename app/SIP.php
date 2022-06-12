<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SIP extends Model
{
    protected $table = 'sip';

    public $timestamps = false;

    protected $fillable = [
        "instance",
        "iterator",
        "idstr",
        "idpegawai",
        "nomorstr",
        "expirystr",
        "nomorrekom",
        "nomor",
        "idc",
        "idm",
        "idfaskes",
        "saranapraktik",
        "namafaskes",
        "alamatfaskes",
        "jadwalpraktik",
        "jenispermohonan",
        "jabatan",
        "tglonline",
        "tglmasukdinas",
        "tglverif",
        "tgldeactive",
        "isactive",
    ];
    
}
