<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinggalBersamaStatusModel extends Model
{
    use HasFactory;
    protected $table = 'tinggal_bersama_status';
    protected $guarded = ['id'];
}
