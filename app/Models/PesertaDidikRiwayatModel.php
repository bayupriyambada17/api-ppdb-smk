<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaDidikRiwayatModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik_riwayat';
    protected $guarded = ['id'];

    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarahModel::class, 'golongan_darah_id');
    }

    public function setPerokok()
    {
        return $this->perokok == 0 ? "Tidak" : "Ya";
    }
}
