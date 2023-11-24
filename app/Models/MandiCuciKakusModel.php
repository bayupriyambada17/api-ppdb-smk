<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MandiCuciKakusModel extends Model
{
    use HasFactory;
    protected $table = 'mandi_cuci_kakus';
    protected $guarded = ['id'];
}
