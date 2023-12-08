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

    public function pendidikanAyah()
    {
        return $this->hasOne(PendidikanTerakhirModel::class, 'id', 'pendidikan_terakhir_ayah_id');
    }
    public function pendidikanIbu()
    {
        return $this->hasOne(PendidikanTerakhirModel::class, 'id', 'pendidikan_terakhir_ibu_id');
    }
    public function sumberPenghasilan()
    {
        return $this->hasOne(SumberPenghasilanModel::class, 'id', 'sumber_penghasilan_id');
    }
    public function penerimaanBantuanSosial()
    {
        return $this->hasOne(PenerimaanBantuanSosialModel::class, 'id', 'penerimaan_bantuan_sosial_id');
    }
    public function tinggalBersamaOrangTua()
    {
        return $this->hasOne(TinggalBersamaStatusModel::class, 'id', 'tinggal_bersama_status_id');
    }
    public function statusDalamKeluarga()
    {
        return $this->hasOne(StatusDalamKeluargaModel::class, 'id', 'status_dalam_keluarga_id');
    }

    public function keadaanOrangTua()
    {
        return $this->hasOne(KeadaanOrangTuaModel::class, 'id', 'id', 'keadaan_orang_tua_id');
    }
    public function tahunLulus()
    {
        return $this->belongsTo(TahunLulusModel::class, 'tahun_lulus_id');
    }

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
            $pendaftaran->nomor_pendaftar = '#' . str_replace("/", "", $pendaftaran->tahunPelajaran->tahun_pelajaran) . $pendaftaran->nisn;
        });
    }
}
