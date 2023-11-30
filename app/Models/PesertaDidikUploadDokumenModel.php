<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesertaDidikUploadDokumenModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik_upload_dokumen';
    protected $guarded = ['id'];

    protected function kartuKeluarga(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('/storage/kartu_keluarga/' . $value) : null

        );
    }
    protected function pasFoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('/storage/pas_foto/' . $value) : null
        );
    }
    protected function sktm(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('/storage/sktm/' . $value) : null
        );
    }
    protected function uploadSuratRekomendasi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('/storage/surat_rekomendasi/' . $value) : null

        );
    }
    protected function uploadPdfFotoRumah(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('/storage/pdf_foto_rumah/' . $value) : null

        );
    }
    protected function essayKarangan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('/storage/essay_karangan/' . $value) : null
        );
    }
    protected function rangkaianTes(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Ya" : "Tidak"
        );
    }
    protected function dokumenJikaPalsu(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Ya" : "Tidak"
        );
    }
    protected function pelanggaranKeputusan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? "Ya" : "Tidak"
        );
    }
}
