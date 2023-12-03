<?php

namespace App\Models;

use App\Models\PesertaDidikModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TinggalBersamaStatusModel extends Model
{
    use HasFactory;
    protected $table = 'tinggal_bersama_status';
    protected $guarded = ['id'];

    public function pesertaDidik()
    {
        return $this->hasOne(PesertaDidikModel::class, 'tinggal_bersama_status_id', 'id');
    }
}
