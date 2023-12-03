<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GolonganDarahModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'golongan_darah';
    protected $guarded = ['id'];

    public function pesertaRiwayat()
    {
        return $this->hasOne(PesertaDidikRiwayatModel::class, 'golongan_darah_id');
    }
}
