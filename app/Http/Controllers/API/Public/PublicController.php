<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Models\{
    DayaListrikModel,
    KeadaanOrangTuaModel,
    PenerimaanBantuanSosialModel,
    StatusDalamKeluargaModel,
    StatusKepemilikanRumahModel,
    SumberAirModel,
    SumberPenghasilanModel,
    TahunPelajaranModel,
    TinggalBersamaStatusModel
};

class PublicController extends Controller
{
    public function getActiveTahunPelajaran()
    {

        return NotificationStatus::notifSuccess(
            true,
            ConstantaHelper::DataDiambil,
            TahunPelajaranModel::where('isActive', 1)->get(),
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
}
