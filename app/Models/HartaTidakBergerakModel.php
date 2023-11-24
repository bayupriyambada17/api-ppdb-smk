<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HartaTidakBergerakModel extends Model
{
    use HasFactory;
    protected $table = 'harta_tidak_bergerak';
    protected $guarded = ['id'];
}
