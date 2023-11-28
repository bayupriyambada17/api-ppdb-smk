<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaDidikFasilitatorModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik_fasilitator';
    protected $guarded = ['id'];

    public function informasiPpdb()
    {
        return $this->belongsTo(InformasiPpdbModel::class, 'informasi_ppdb_id');
    }
}
