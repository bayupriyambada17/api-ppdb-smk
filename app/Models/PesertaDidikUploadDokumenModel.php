<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaDidikUploadDokumenModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik_upload_dokumen';
    protected $guarded = ['id'];
}
