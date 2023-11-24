<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunPelajaranModel extends Model
{
    use HasFactory;

    protected $table = 'tahun_pelajaran';
    protected $guarded = ['id'];
}
