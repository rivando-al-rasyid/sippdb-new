<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiodataOrtu extends Model
{
    protected $guarded = [];
    protected $table = "tbl_biodata_ortu";

    public function peserta()
    {
        return $this->belongsTo(PesertaPPDB::class, 'id_peserta_ppdb');
    }

    public function pekerjaan_ayah()
    {
        return $this->belongsTo(PekerjaanOrtu::class, 'id_pekerjaan_ayah');
    }

    public function pekerjaan_ibu()
    {
        return $this->belongsTo(PekerjaanOrtu::class, 'id_pekerjaan_ibu');
    }

    public function penghasilan_ayah()
    {
        return $this->belongsTo(PenghasilanOrtu::class, 'id_penghasilan_ayah');
    }

    public function penghasilan_ibu()
    {
        return $this->belongsTo(PenghasilanOrtu::class, 'id_penghasilan_ibu');
    }
}
