<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faskes extends Model
{
    protected $table = 'mfaskes';

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "alamat",
        "idkategori",
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }
}
