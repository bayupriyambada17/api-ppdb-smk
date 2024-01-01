<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Helpers\{
    ConstantaHelper,
    NotificationStatus
};
use App\Http\Resources\DataPublic\{
    PublicResource,
    ProvinsiResource,
    TahunPelajaranActiveResource
};
use App\Models\{
    BannerPendaftaranModel,
    DayaListrikModel,
    GolonganDarahModel,
    HartaTidakBergerakModel,
    InformasiPpdbModel,
    KeadaanOrangTuaModel,
    KepemilikanKendaraanModel,
    KualitasRumahModel,
    LuasTanahModel,
    MandiCuciKakusModel,
    PendidikanTerakhirModel,
    PenerimaanBantuanSosialModel,
    ProvinsiModel,
    StatusDalamKeluargaModel,
    StatusKepemilikanHartaTidakBergerakModel,
    StatusKepemilikanKendaraanModel,
    StatusKepemilikanRumahModel,
    SumberAirModel,
    SumberPenghasilanModel,
    TahunLulusModel,
    TahunPelajaranModel,
    TinggalBersamaStatusModel
};

class PublicController extends Controller
{
    public function getBanner()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            BannerPendaftaranModel::get(),
            200
        );
    }
    public function getKualitasRumah()
    {
        return $this->getFunctionPublicResource(KualitasRumahModel::get());
    }
    public function getLuasTanah()
    {
        return $this->getFunctionPublicResource(LuasTanahModel::get());
    }
    public function getPendidikanTerakhir()
    {
        return $this->getFunctionPublicResource(PendidikanTerakhirModel::get());

    }
    public function getProvinsi()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            ProvinsiResource::collection(ProvinsiModel::get()),
            200
        );
    }
    public function getTahunPelajaran()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            TahunPelajaranActiveResource::collection(TahunPelajaranModel::where('is_active', 1)->get()),
            200
        );
    }
    public function getTahunLulus()
    {

        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            TahunLulusModel::where('is_active', 1)->get(),
            200
        );
    }

    public function getKeadaanOrangTua()
    {
        return $this->getFunctionPublicResource(KeadaanOrangTuaModel::get());
    }
    public function getPenerimaBantuanSosial()
    {
        return $this->getFunctionPublicResource(PenerimaanBantuanSosialModel::get());
    }
    public function getStatusDalamKeluarga()
    {
        return $this->getFunctionPublicResource(StatusDalamKeluargaModel::get());
    }
    public function getTinggalBersama()
    {
        return $this->getFunctionPublicResource(TinggalBersamaStatusModel::get());
    }
    public function getSumberPenghasilan()
    {
        return $this->getFunctionPublicResource(SumberPenghasilanModel::get());
    }
    public function getStatusKepemilikanRumah()
    {
        return $this->getFunctionPublicResource(StatusKepemilikanRumahModel::get());
    }
    public function getDayaListrik()
    {
        return $this->getFunctionPublicResource(DayaListrikModel::get());
    }
    public function getSumberAir()
    {
        return $this->getFunctionPublicResource(SumberAirModel::get());
    }
    public function getHartaTidakBergerak()
    {
        return $this->getFunctionPublicResource(HartaTidakBergerakModel::get());
    }
    public function getStatusHartaTidakBergerak()
    {
        return $this->getFunctionPublicResource(StatusKepemilikanHartaTidakBergerakModel::get());

    }
    public function getKepemilikanKendaraan()
    {
        return $this->getFunctionPublicResource(KepemilikanKendaraanModel::get());
    }
    public function getStatusKepemilikanKendaraan()
    {
        return $this->getFunctionPublicResource(StatusKepemilikanKendaraanModel::get());
    }
    public function getMandiCuciKakus()
    {
        return $this->getFunctionPublicResource(MandiCuciKakusModel::get());
    }
    public function getGolonganDarah()
    {
        return $this->getFunctionPublicResource(GolonganDarahModel::get());
    }
    public function getInformasiPpdb()
    {
        return $this->getFunctionPublicResource(InformasiPpdbModel::get());
    }

    private function getFunctionPublicResource(object $model)
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            PublicResource::collection($model),
            200
        );
    }
}
