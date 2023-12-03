<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiPpdbModel extends Model
{
    use HasFactory;
    protected $table = 'informasi_ppdb';
    protected $guarded = ['id'];

    public function pesertaDidikFasilitator()
    {
        return $this->hasOne(PesertaDidikFasilitatorModel::class, 'informasi_ppdb_id');
    }
}
