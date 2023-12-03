<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaDidikFisilitasModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusKepemilikanHartaTidakBergerakModel extends Model
{
    use HasFactory;
    protected $table = 'status_kepemilikan_harta_tidak_bergerak';
    protected $guarded = ['id'];

    public function pesertaDidikFasilitas()
    {
        return $this->hasOne(PesertaDidikFisilitasModel::class, 'status_kepemelikan_htb_id');
    }
}
