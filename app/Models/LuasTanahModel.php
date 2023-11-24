<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuasTanahModel extends Model
{
    use HasFactory;
    protected $table = 'luas_tanah';
    protected $guarded = ['id'];
}
