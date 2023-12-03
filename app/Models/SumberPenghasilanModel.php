<?php

namespace App\Models;

use App\Models\PesertaDidikModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SumberPenghasilanModel extends Model
{
    use HasFactory;
    protected $table = 'sumber_penghasilan';
    protected $guarded = ['id'];

    public function pesertaDidik()
    {
        return $this->hasOne(PesertaDidikModel::class, 'sumber_penghasilan_id');
    }
}
