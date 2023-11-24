<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberPenghasilanModel extends Model
{
    use HasFactory;
    protected $table = 'sumber_penghasilan';
    protected $guarded = ['id'];
}
