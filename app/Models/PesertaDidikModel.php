<?php

namespace App\Models;

use App\Models\PesertaDidikRaporModel;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    PesertaDidikUploadDokumenModel,
    PesertaDidikFasilitatorModel,
    PesertaDidikRiwayatModel,
    PesertaDidikFisilitasModel,
    ProvinsiModel
};
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesertaDidikModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik';
    protected $guarded = ['id'];

    public function tahunPelajaran()
    {
        return $this->belongsTo(TahunPelajaranModel::class, 'tahun_pelajaran_id');
    }
    public function provinsi()
    {
        return $this->belongsTo(ProvinsiModel::class, 'provinsi_id');
    }

    public function rapor()
    {
        return $this->hasOne(PesertaDidikRaporModel::class, 'peserta_didik_id');
    }

    public function fasilitator()
    {
        return $this->hasOne(PesertaDidikFasilitatorModel::class, 'peserta_didik_id');
    }

    public function fasilitas()
    {
        return $this->hasOne(PesertaDidikFisilitasModel::class, 'peserta_didik_id');
    }

    public function riwayatPenyakit()
    {
        return $this->hasOne(PesertaDidikRiwayatModel::class, 'peserta_didik_id');
    }
    public function uploadDokumen()
    {
        return $this->hasOne(PesertaDidikUploadDokumenModel::class, 'peserta_didik_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pendaftaran) {
            $tahunAjar = $pendaftaran->tahunPelajaran;
            $tahunPelajaran = $tahunAjar->tahun_pelajaran;
            $tahunPelajaranParts = explode('/', $tahunPelajaran);
            $tahunPelajaranSingkat = substr($tahunPelajaranParts[0], -2) . substr($tahunPelajaranParts[1], -2);

            $pendaftaran->nomor_pendaftar = '#' . $tahunAjar->tahun_ajaran . $tahunPelajaranSingkat . $pendaftaran->nisn;
        });
    }
}
