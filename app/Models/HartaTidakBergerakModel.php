<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaDidikFisilitasModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HartaTidakBergerakModel extends Model
{
    use HasFactory;
    protected $table = 'harta_tidak_bergerak';
    protected $guarded = ['id'];
    public function pesertaDidikFasilitas()
    {
        return $this->hasOne(PesertaDidikFisilitasModel::class, 'harta_tidak_bergerak_id');
    }
}
