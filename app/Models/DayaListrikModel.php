<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayaListrikModel extends Model
{
    use HasFactory;
    protected $table = 'daya_listrik';
    protected $guarded = ['id'];
}
