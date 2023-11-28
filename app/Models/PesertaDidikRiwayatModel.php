<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesertaDidikRiwayatModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik_riwayat';
    protected $guarded = ['id'];

    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarahModel::class, 'golongan_darah_id')->select("id", "status");
    }

    protected function perokok(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Ya" : "Tidak"
        );
    }
    protected function butaWarna(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Ya" : "Tidak"
        );
    }
    protected function asuransiBpjsKis(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Ya" : "Tidak"
        );
    }
}
