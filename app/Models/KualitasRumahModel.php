<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaDidikFisilitasModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KualitasRumahModel extends Model
{
    use HasFactory;
    protected $table = 'kualitas_rumah';
    protected $guarded = ['id'];

    public function pesertaDidikFasilitas()
    {
        return $this->hasOne(PesertaDidikFisilitasModel::class, 'kualitas_rumah_id');
    }
}
