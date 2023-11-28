<?php

namespace App\Models;

use App\Models\PesertaDidikModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProvinsiModel extends Model
{
    use HasFactory;
    protected $table = 'provinsi';
    protected $guarded = ['id'];

    public function pesertaDidik()
    {
        return $this->hasMany(PesertaDidikModel::class, 'provinsi_id');
    }
}
