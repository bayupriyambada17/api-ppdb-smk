<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaDidikFisilitasModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusKepemilikanKendaraanModel extends Model
{
    use HasFactory;

    protected $table = 'status_kepemilikan_kendaraan';
    protected $guarded = ['id'];

    public function pesertaDidikFasilitas()
    {
        return $this->hasOne(PesertaDidikFisilitasModel::class, 'status_kepemilikan_kendaraan_id');
    }
}
