<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanBantuanSosialModel extends Model
{
    use HasFactory;
    protected $table = 'penerimaan_bantuan_sosial';
    protected $guarded = ['id'];
}
