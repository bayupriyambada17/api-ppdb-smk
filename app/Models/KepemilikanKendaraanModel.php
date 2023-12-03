<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaDidikFisilitasModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KepemilikanKendaraanModel extends Model
{
    use HasFactory;
    protected $table = 'kepemilikan_kendaraan';
    protected $guarded = ['id'];

    public function pesertaDidikFasilitas()
    {
        return $this->hasOne(PesertaDidikFisilitasModel::class, 'kepemilikan_kendaraan_id');
    }
}
