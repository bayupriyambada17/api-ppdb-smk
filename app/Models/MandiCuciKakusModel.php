<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PesertaDidikFisilitasModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MandiCuciKakusModel extends Model
{
    use HasFactory;
    protected $table = 'mandi_cuci_kakus';
    protected $guarded = ['id'];

    public function pesertaDidikFasilitas()
    {
        return $this->hasOne(PesertaDidikFisilitasModel::class, 'mandi_cuci_kakus_id');
    }
}
