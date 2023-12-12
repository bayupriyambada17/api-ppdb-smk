<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannerPendaftaranModel extends Model
{
    use HasFactory;

    protected $table = 'banner_pendaftaran';
    protected $guarded = ['id'];

    protected function gambar(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('files/gambar_ppdb/' . $value)

        );
    }
}
