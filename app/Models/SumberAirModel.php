<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberAirModel extends Model
{
    use HasFactory;
    protected $table = 'sumber_air';
    protected $guarded = ['id'];
}
