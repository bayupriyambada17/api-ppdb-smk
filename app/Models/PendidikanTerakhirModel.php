<?php

namespace App\Models;

use App\Models\PesertaDidikModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendidikanTerakhirModel extends Model
{
    use HasFactory;
    protected $table = 'pendidikan_terakhir';
    protected $guarded = ['id'];

    public function pesertaDidikPendidikanAyah()
    {
        return $this->hasOne(PesertaDidikModel::class, 'pendidikan_terakhir_ayah_id');
    }
    public function pesertaDidikPendidikanIbu()
    {
        return $this->hasOne(PesertaDidikModel::class, 'pendidikan_terakhir_ibu_id');
    }
}
