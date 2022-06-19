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
        "nomorregis",
        "idprofesi",
        "idspesialisasi",
        "nomorstr",
        "expirystr",

        "saranapraktik",
        "namafaskes",
        "alamatfaskes",

        "instance",
        "iterator",
        "nomor",
        "nomorrekom",
        "nomoronline",
        "idfaskes",
        "jadwalpraktik",
        "jenispermohonan",
        "jabatan",
        "tglonline",
        "tglmasukdinas",
        "tglverif",
        "tgldeactive",
        "isactive",
        "idc",
        "idm",

    ];
    
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idpegawai');
    }
}
