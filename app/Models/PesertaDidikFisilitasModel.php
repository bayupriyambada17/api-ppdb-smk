<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaDidikFisilitasModel extends Model
{
    use HasFactory;
    protected $table = 'peserta_didik_fasilitas';
    protected $guarded = ['id'];

    public function statusKepemilikanRumah()
    {
        return $this->belongsTo(StatusKepemilikanRumahModel::class, 'status_kepemilikan_rumah_id');
    }
    public function kualitasRumah()
    {
        return $this->belongsTo(KualitasRumahModel::class, 'kualitas_rumah_id');
    }
    public function luasTanah()
    {
        return $this->belongsTo(LuasTanahModel::class, 'luas_tanah_id');
    }
    public function mandiCuciKakus()
    {
        return $this->belongsTo(MandiCuciKakusModel::class, 'mandi_cuci_kakus_id');
    }
    public function sumberAir()
    {
        return $this->belongsTo(SumberAirModel::class, 'sumber_air_id');
    }
    public function dayaListrik()
    {
        return $this->belongsTo(DayaListrikModel::class, 'daya_listrik_id');
    }
    public function hartaTidakBergerak()
    {
        return $this->belongsTo(HartaTidakBergerakModel::class, 'harta_tidak_bergerak_id');
    }
    public function statusKepemilikanHtb()
    {
        return $this->belongsTo(StatusKepemilikanHartaTidakBergerakModel::class, 'status_kepemelikan_htb_id');
    }
    public function kepemilikanKendaraan()
    {
        return $this->belongsTo(KepemilikanKendaraanModel::class, 'kepemilikan_kendaraan_id');
    }
    public function statusKepemilikanKendaraan()
    {
        return $this->belongsTo(StatusKepemilikanKendaraanModel::class, 'status_kepemilikan_kendaraan_id');
    }
}
