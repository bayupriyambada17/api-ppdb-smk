<?php

namespace App\Models;

use App\Models\PesertaDidikModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusDalamKeluargaModel extends Model
{
    use HasFactory;
    protected $table = 'status_dalam_keluarga';
    protected $guarded = ['id'];

    public function pesertaDidik()
    {
        return $this->hasOne(PesertaDidikModel::class, 'status_dalam_keluarga_id');
    }
}
