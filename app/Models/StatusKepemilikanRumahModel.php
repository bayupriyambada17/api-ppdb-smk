<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKepemilikanRumahModel extends Model
{
    use HasFactory;
    protected $table = 'status_kepemilikan_rumah';
    protected $guarded = ['id'];
}
