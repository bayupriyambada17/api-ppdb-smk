<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKepemilikanHartaTidakBergerakModel extends Model
{
    use HasFactory;
    protected $table = 'status_kepemilikan_harta_tidak_bergerak';
    protected $guarded = ['id'];
}
