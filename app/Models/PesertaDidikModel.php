<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaDidikModel extends Model
{
    use HasFactory;
    protected $table = 'status_dalam_keluarga';
    protected $guarded = ['id'];
}