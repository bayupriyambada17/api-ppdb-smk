<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanBantuanSosialModel extends Model
{
    use HasFactory;
    protected $table = 'penerimaan_bantuan_sosial';
    protected $guarded = ['id'];

    public function pesertaDidik()
    {
        return $this->hasOne(PesertaDidikModel::class, 'penerimaan_bantuan_sosial_id');
    }
}
