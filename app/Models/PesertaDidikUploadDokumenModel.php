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
            get: fn ($value) => asset('/storage/kartu_keluarga/' . $value)

        );
    }
    protected function pasFoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/pas_foto/' . $value)
        );
    }
    protected function sktm(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/sktm/' . $value)
        );
    }
    protected function scanBjpsKis(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/scan_bpjs_kis/' . $value)
        );
    }
    protected function uploadSuratRekomendasi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/surat_rekomendasi/' . $value)

        );
    }
    protected function uploadPdfFotoRumah(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/pdf_foto_rumah/' . $value)

        );
    }
    protected function essayKarangan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/essay_karangan/' . $value)
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
