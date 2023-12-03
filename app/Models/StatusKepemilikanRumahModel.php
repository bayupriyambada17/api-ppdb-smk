<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaDidikFasilitatorModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusKepemilikanRumahModel extends Model
{
    use HasFactory;
    protected $table = 'status_kepemilikan_rumah';
    protected $guarded = ['id'];

    public function pesertaDidikFasilitas()
    {
        return $this->hasOne(PesertaDidikFisilitasModel::class, 'status_kepemilikan_rumah_id');
    }
}
