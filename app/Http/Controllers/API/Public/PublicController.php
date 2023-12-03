<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Models\{
    DayaListrikModel,
    GolonganDarahModel,
    HartaTidakBergerakModel,
    InformasiPpdbModel,
    KeadaanOrangTuaModel,
    KepemilikanKendaraanModel,
    MandiCuciKakusModel,
    PenerimaanBantuanSosialModel,
    ProvinsiModel,
    StatusDalamKeluargaModel,
    StatusKepemilikanHartaTidakBergerakModel,
    StatusKepemilikanKendaraanModel,
    StatusKepemilikanRumahModel,
    SumberAirModel,
    SumberPenghasilanModel,
    TahunPelajaranModel,
    TinggalBersamaStatusModel
};

class PublicController extends Controller
{
    public function getProvinsi()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            ProvinsiModel::select("id", "name")->get(),
            200
        );
    }
    public function getTahunPelajaran()
    {

        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            TahunPelajaranModel::where('is_active', "Ya")->get(),
            200
        );
    }
    public function getTahunAktif()
    {

        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            TahunPelajaranModel::get(),
            200
        );
    }
    public function getKeadaanOrangTua()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            KeadaanOrangTuaModel::get(),
            200
        );
    }
    public function getPenerimaBantuanSosial()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            PenerimaanBantuanSosialModel::get(),
            200
        );
    }
    public function getStatusDalamKeluarga()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            StatusDalamKeluargaModel::get(),
            200
        );
    }
    public function getTinggalBersama()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            TinggalBersamaStatusModel::get(),
            200
        );
    }
    public function getSumberPenghasilan()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            SumberPenghasilanModel::get(),
            200
        );
    }
    public function getStatusKepemilikanRumah()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            StatusKepemilikanRumahModel::get(),
            200
        );
    }
    public function getDayaListrik()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            DayaListrikModel::get(),
            200
        );
    }
    public function getSumberAir()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            SumberAirModel::get(),
            200
        );
    }
    public function getHartaTidakBergerak()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            HartaTidakBergerakModel::get(),
            200
        );
    }
    public function getStatusHartaTidakBergerak()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            StatusKepemilikanHartaTidakBergerakModel::get(),
            200
        );
    }
    public function getKepemilikanKendaraan()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            KepemilikanKendaraanModel::get(),
            200
        );
    }
    public function getStatusKepemilikanKendaraan()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            StatusKepemilikanKendaraanModel::get(),
            200
        );
    }
    public function getMandiCuciKakus()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            MandiCuciKakusModel::get(),
            200
        );
    }
    public function getGolonganDarah()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            GolonganDarahModel::get(),
            200
        );
    }
    public function getInformasiPpdb()
    {
        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            InformasiPpdbModel::get(),
            200
        );
    }
}
