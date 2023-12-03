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
            $tahunAjar = $pendaftaran->tahunPelajaran;
            $tahunPelajaran = $tahunAjar->tahun_pelajaran;
            $tahunPelajaranParts = explode('/', $tahunPelajaran);
            $tahunPelajaranSingkat = substr($tahunPelajaranParts[0], -2) . substr($tahunPelajaranParts[1], -2);

            $pendaftaran->nomor_pendaftar = '#' . $tahunAjar->tahun_ajaran . $tahunPelajaranSingkat . $pendaftaran->nisn;
        });
    }

    public static function generateNomorPendaftaran($tahunPelajaran)
    {
        // Mendapatkan ID terakhir dari peserta didik dengan tahun pelajaran yang sama
        $lastId = static::where('nomor_pendaftar', 'like', $tahunPelajaran . '%')
            ->max('nomor_pendaftar');

        // Mengambil angka ID dari nomor pendaftaran terakhir
        $lastIdNumber = intval(substr($lastId, strlen($tahunPelajaran)));

        // Increment angka ID
        $newIdNumber = $lastIdNumber + 1;

        // Menghitung panjang digit dari angka ID terakhir
        $digitLength = strlen((string)$lastIdNumber);

        // Membuat nomor pendaftaran baru dengan format sesuai panjang digit
        $nomorPendaftaran = '#' . $tahunPelajaran . str_pad($newIdNumber, $digitLength, '0', STR_PAD_LEFT);

        return $nomorPendaftaran;
    }
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($pendaftaran) {
    //         $tahunAjar = $pendaftaran->tahunPelajaran;
    //         $tahunPelajaran = $tahunAjar->tahun_pelajaran;
    //         $tahunPelajaranParts = explode('/', $tahunPelajaran);
    //         $tahunPelajaranSingkat = substr($tahunPelajaranParts[0], -2) . substr($tahunPelajaranParts[1], -2);

    //         // Menggunakan model untuk membuat nomor pendaftaran
    //         $nomorPendaftaran = PesertaDidikModel::generateNomorPendaftaran($tahunAjar->tahun_ajaran . $tahunPelajaranSingkat);

    //         $pendaftaran->nomor_pendaftar = $nomorPendaftaran;
    //     });
    // }
}
