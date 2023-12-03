<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunLulusModel extends Model
{
    use HasFactory;
    protected $table = 'tahun_lulus';
    protected $guarded = ['id'];

    // public function pesertaDidik()
    // {
    //     return $this->hasMany(PesertaDidikModel::class);
    // }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Ya" : "Tidak"
        );
    }
}
