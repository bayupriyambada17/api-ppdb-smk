<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeadaanOrangTuaModel extends Model
{
    use HasFactory;
    protected $table = 'keadaan_orang_tua';
    protected $guarded = ['id'];
}
