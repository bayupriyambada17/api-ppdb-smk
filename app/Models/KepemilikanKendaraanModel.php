<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepemilikanKendaraanModel extends Model
{
    use HasFactory;
    protected $table = 'kepemilikan_kendaraan';
    protected $guarded = ['id'];
}
