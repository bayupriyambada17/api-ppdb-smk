<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KualitasRumahModel extends Model
{
    use HasFactory;
    protected $table = 'kualitas_rumah';
    protected $guarded = ['id'];
}
