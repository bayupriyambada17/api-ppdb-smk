<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesertaDidikFasilitatorModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik_fasilitator';
    protected $guarded = ['id'];

    public function informasiPpdb()
    {
        return $this->hasOne(InformasiPpdbModel::class, 'informasi_ppdb_id');
    }

    protected function saudaraBeasiswaDiSmkFasilitator(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Ya" : "Tidak"
        );
    }
}
