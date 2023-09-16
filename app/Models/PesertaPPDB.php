<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaPPDB extends Model
{
    protected $guarded = [];

    protected $table = "tbl_peserta_ppdb";

    public function orang_tua()
    {
        return $this->hasOne(BiodataOrtu::class, 'id_peserta_ppdb', 'id');
    }
}
