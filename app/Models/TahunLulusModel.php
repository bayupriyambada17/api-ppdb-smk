<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunLulusModel extends Model
{
    use HasFactory;
    protected $table = 'tahun_lulus';
    protected $guarded = ['id'];

    // public function pesertaDidik()
    // {
    //     return $this->hasMany(PesertaDidikModel::class);
    // }
}
