<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Public\PublicController;
use App\Http\Controllers\API\{
    AuthController,
    DayaListrikController,
    HartaTidakBergerakController,
    KeadanOrangTuaController,
    KepemilikanKendaraanController,
    PenerimaanBantuanSosialController,
    StatusDalamKeluargaController,
    StatusHartaTidakBergerakController,
    StatusKepemilikanKendaraanController,
    StatusKepemilikanRumahController,
    SumberAirController,
    SumberPenghasilanController,
    TahunLulusController,
    TahunPengajaranController
};
use App\Models\MandiCuciKakusModel;

Route::prefix('/v1')->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post("/login", [AuthController::class, 'login']);
    });

    Route::prefix('public')->group(function () {
        Route::get("/tahun-pengajaran", [PublicController::class, 'getActiveTahunPelajaran']);
        Route::get("/keadaan-orang-tua", [PublicController::class, 'getKeadaanOrangTua']);
        Route::get("/penerima-bantuan-sosial", [PublicController::class, 'getPenerimaBantuanSosial']);
        Route::get("/status-dalam-keluarga", [PublicController::class, 'getStatusDalamKeluarga']);
        Route::get("/tinggal-bersama", [PublicController::class, 'getTinggalBersama']);
        Route::get("/sumber-penghasilan", [PublicController::class, 'getSumberPenghasilan']);
        Route::get("/status-kepemilikan-rumah", [PublicController::class, 'getStatusKepemilikanRumah']);
        Route::get("/daya-listrik", [PublicController::class, 'getDayaListrik']);
        Route::get("/sumber-air", [PublicController::class, 'getSumberAir']);
        Route::get("/harta-tidak-bergerak", [PublicController::class, 'getHartaTidakBergerak']);
        Route::get("/status-harta-tidak-bergerak", [PublicController::class, 'getStatusHartaTidakBergerak']);
        Route::get("/kepemilikan-kendaraan", [PublicController::class, 'getKepemilikanKendaraan']);
        Route::get("/status-kepemilikan-kendaraan", [PublicController::class, 'getStatusKepemilikanKendaraan']);
        Route::get("/mandi-cuci-kakus", [PublicController::class, 'getMandiCuciKakus']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/v1')->group(function () {
        Route::prefix('/auth')->group(function () {
            Route::post("/logout", [AuthController::class, 'logout']);
        });

        Route::prefix('tahun-pengajaran')->group(function () {
            Route::get('', [TahunPengajaranController::class, 'all']);
            Route::post('/tambah', [TahunPengajaranController::class, 'store']);
            Route::post('/{id}/ubah', [TahunPengajaranController::class, 'update']);
            Route::delete('/{id}/hapus', [TahunPengajaranController::class, 'destroy']);
        });
        Route::prefix('tahun-lulus')->group(function () {
            Route::get('', [TahunLulusController::class, 'all']);
            Route::post('/tambah', [TahunLulusController::class, 'store']);
            Route::post('/{id}/ubah', [TahunLulusController::class, 'update']);
            Route::delete('/{id}/hapus', [TahunLulusController::class, 'destroy']);
        });
        Route::prefix('keadaan-orang-tua')->group(function () {
            Route::get('', [KeadanOrangTuaController::class, 'all']);
            Route::post('/tambah', [KeadanOrangTuaController::class, 'store']);
            Route::post('/{id}/ubah', [KeadanOrangTuaController::class, 'update']);
            Route::delete('/{id}/hapus', [KeadanOrangTuaController::class, 'destroy']);
        });
        Route::prefix('penerimaan-bantuan-sosial')->group(function () {
            Route::get('', [PenerimaanBantuanSosialController::class, 'all']);
            Route::post('/tambah', [PenerimaanBantuanSosialController::class, 'store']);
            Route::post('/{id}/ubah', [PenerimaanBantuanSosialController::class, 'update']);
            Route::delete('/{id}/hapus', [PenerimaanBantuanSosialController::class, 'destroy']);
        });
        Route::prefix('status-dalam-keluarga')->group(function () {
            Route::get('', [StatusDalamKeluargaController::class, 'all']);
            Route::post('/tambah', [StatusDalamKeluargaController::class, 'store']);
            Route::post('/{id}/ubah', [StatusDalamKeluargaController::class, 'update']);
            Route::delete('/{id}/hapus', [StatusDalamKeluargaController::class, 'destroy']);
        });
        Route::prefix('sumber-penghasilan')->group(function () {
            Route::get('', [SumberPenghasilanController::class, 'all']);
            Route::post('/tambah', [SumberPenghasilanController::class, 'store']);
            Route::post('/{id}/ubah', [SumberPenghasilanController::class, 'update']);
            Route::delete('/{id}/hapus', [SumberPenghasilanController::class, 'destroy']);
        });
        Route::prefix('status-kepemilikan-rumah')->group(function () {
            Route::get('', [StatusKepemilikanRumahController::class, 'all']);
            Route::post('/tambah', [StatusKepemilikanRumahController::class, 'store']);
            Route::post('/{id}/ubah', [StatusKepemilikanRumahController::class, 'update']);
            Route::delete('/{id}/hapus', [StatusKepemilikanRumahController::class, 'destroy']);
        });
        Route::prefix('sumber-air')->group(function () {
            Route::get('', [SumberAirController::class, 'all']);
            Route::post('/tambah', [SumberAirController::class, 'store']);
            Route::post('/{id}/ubah', [SumberAirController::class, 'update']);
            Route::delete('/{id}/hapus', [SumberAirController::class, 'destroy']);
        });
        Route::prefix('daya-listrik')->group(function () {
            Route::get('', [DayaListrikController::class, 'all']);
            Route::post('/tambah', [DayaListrikController::class, 'store']);
            Route::post('/{id}/ubah', [DayaListrikController::class, 'update']);
            Route::delete('/{id}/hapus', [DayaListrikController::class, 'destroy']);
        });
        Route::prefix('harta-tidak-bergerak')->group(function () {
            Route::get('', [HartaTidakBergerakController::class, 'all']);
            Route::post('/tambah', [HartaTidakBergerakController::class, 'store']);
            Route::post('/{id}/ubah', [HartaTidakBergerakController::class, 'update']);
            Route::delete('/{id}/hapus', [HartaTidakBergerakController::class, 'destroy']);
        });
        Route::prefix('status-harta-tidak-bergerak')->group(function () {
            Route::get('', [StatusHartaTidakBergerakController::class, 'all']);
            Route::post('/tambah', [StatusHartaTidakBergerakController::class, 'store']);
            Route::post('/{id}/ubah', [StatusHartaTidakBergerakController::class, 'update']);
            Route::delete('/{id}/hapus', [StatusHartaTidakBergerakController::class, 'destroy']);
        });
        Route::prefix('kepemilikan-kendaraan')->group(function () {
            Route::get('', [KepemilikanKendaraanController::class, 'all']);
            Route::post('/tambah', [KepemilikanKendaraanController::class, 'store']);
            Route::post('/{id}/ubah', [KepemilikanKendaraanController::class, 'update']);
            Route::delete('/{id}/hapus', [KepemilikanKendaraanController::class, 'destroy']);
        });
        Route::prefix('status-kepemilikan-kendaraan')->group(function () {
            Route::get('', [StatusKepemilikanKendaraanController::class, 'all']);
            Route::post('/tambah', [StatusKepemilikanKendaraanController::class, 'store']);
            Route::post('/{id}/ubah', [StatusKepemilikanKendaraanController::class, 'update']);
            Route::delete('/{id}/hapus', [StatusKepemilikanKendaraanController::class, 'destroy']);
        });
        Route::prefix('mandi-cuci-kakus')->group(function () {
            Route::get('', [MandiCuciKakusModel::class, 'all']);
            Route::post('/tambah', [MandiCuciKakusModel::class, 'store']);
            Route::post('/{id}/ubah', [MandiCuciKakusModel::class, 'update']);
            Route::delete('/{id}/hapus', [MandiCuciKakusModel::class, 'destroy']);
        });
    });
});
