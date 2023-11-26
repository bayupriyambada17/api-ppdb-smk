<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaDidikRaporModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik_rapor';
    protected $guarded = ['id'];
}
