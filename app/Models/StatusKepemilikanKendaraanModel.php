<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKepemilikanKendaraanModel extends Model
{
    use HasFactory;

    protected $table = 'status_kepemilikan_kendaraan';
    protected $guarded = ['id'];
}
