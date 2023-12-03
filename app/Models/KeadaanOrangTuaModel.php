<?php

namespace App\Models;

use App\Models\PesertaDidikModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeadaanOrangTuaModel extends Model
{
    use HasFactory;
    protected $table = 'keadaan_orang_tua';
    protected $guarded = ['id'];

    public function pesertaDidik()
    {
        return $this->hasOne(PesertaDidikModel::class, 'keadaan_orang_tua_id', 'id');
    }
}
