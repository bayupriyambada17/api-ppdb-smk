<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Public\{PublicController, PesertaDidikController as PublicPesertaController};
use App\Http\Controllers\API\{
    AuthController,
    BannerPendaftaranController,
    DayaListrikController,
    GolonganDarahController,
    HartaTidakBergerakController,
    InformasiPpdbController,
    KeadanOrangTuaController,
    KepemilikanKendaraanController,
    KualitaRumahController,
    LuasTanahController,
    MandiCuciKakusController,
    PenerimaanBantuanSosialController,
    PesertaDidikController,
    ProvinsiController,
    StatusDalamKeluargaController,
    StatusHartaTidakBergerakController,
    StatusKepemilikanKendaraanController,
    StatusKepemilikanRumahController,
    SumberAirController,
    SumberPenghasilanController,
    TahunLulusController,
    TahunPengajaranController,
    TinggalBersamaController,
};
use App\Http\Controllers\API\Dashboard\DataDashboardController;
use App\Http\Controllers\API\Excel\PesertaDidikController as ExcelPesertaDidikController;

Route::prefix('/v1')->group(function () {

    Route::prefix('public')->group(function () {
        Route::get("/kualitas-rumah", [PublicController::class, 'getKualitasRumah']);
        Route::get("/luas-tanah", [PublicController::class, 'getLuasTanah']);
        Route::get("/banner", [PublicController::class, 'getBanner']);
        Route::get("/tahun-pelajaran", [PublicController::class, 'getTahunPelajaran']);
        Route::get("/tahun-lulus", [PublicController::class, 'getTahunLulus']);
        Route::get("/tahun", [PublicController::class, 'getTahunAktif']);
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
        Route::get("/golongan-darah", [PublicController::class, 'getGolonganDarah']);
        Route::get("/informasi-ppdb", [PublicController::class, 'getInformasiPpdb']);
        Route::get("/provinsi", [PublicController::class, 'getProvinsi']);
        Route::post("/daftar-peserta", [PublicPesertaController::class, 'postPesertaDidik']);
        Route::get("/pendidikan", [PublicController::class, 'getPendidikanTerakhir']);
    });

    Route::post('/login', [
        AuthController::class, 'login'
    ]);
    //group route with middleware "auth:api_admin"
    Route::group(['middleware' => 'auth:ppdb'], function () {
        //data user
        Route::get('/user', [AuthController::class, 'getMe', ['as' => 'ppdb']]);
        Route::get('/refresh', [AuthController::class, 'refreshToken', ['as' => 'ppdb']
        ]);
        Route::post('/logout', [AuthController::class, 'logout', ['as' => 'ppdb']]);

        Route::prefix('dashboard')->group(function () {
            Route::get("/peserta-harian", [DataDashboardController::class, 'getDataPesertaPerhari']);
            Route::get("/peserta/harian", [DataDashboardController::class, 'getPesertaDaftarHarian']);
            Route::get("/per-provinsi", [DataDashboardController::class, 'getProvinsi']);
            Route::get("/total-peserta-didik", [DataDashboardController::class, 'getTotalPesertaDidik']);
            Route::get("/status-peserta-didik", [DataDashboardController::class, 'getPesertaDidikCount']);
        });

        Route::prefix('tahun-pelajaran')->group(function () {
            Route::get('', [TahunPengajaranController::class, 'all']);
            Route::get("/{id}/lihat", [TahunPengajaranController::class, 'viewTahunAjaran']);
            Route::get("/{id}/peserta", [TahunPengajaranController::class, 'showPesertaDidikPelajaran']);
            Route::get("/{id}", [TahunPengajaranController::class, 'show']);
            Route::post('/tambah', [TahunPengajaranController::class, 'store']);
            Route::post('/{id}/ubah', [TahunPengajaranController::class, 'update']);
            Route::delete('/{id}/hapus', [TahunPengajaranController::class, 'destroy']);
        });
        Route::prefix('provinsi')->group(function () {
            Route::get('', [ProvinsiController::class, 'all']);
            Route::get('/{id}', [ProvinsiController::class, 'show']);
            Route::post('/tambah', [ProvinsiController::class, 'store']);
            Route::post('/{id}/ubah', [ProvinsiController::class, 'update']);
            Route::delete('/{id}/hapus', [ProvinsiController::class, 'destroy']);
        });
        Route::prefix('tahun-lulus')->group(function () {
            Route::get('', [TahunLulusController::class, 'all']);
            Route::get('/{id}', [TahunLulusController::class, 'show']);
            Route::post('/tambah', [TahunLulusController::class, 'store']);
            Route::post('/{id}/ubah', [TahunLulusController::class, 'update']);
            Route::delete('/{id}/hapus', [TahunLulusController::class, 'destroy']);
        });
        Route::prefix('keadaan-orang-tua')->group(function () {
            Route::get('', [KeadanOrangTuaController::class, 'all']);
            Route::get('/{id}', [KeadanOrangTuaController::class, 'show']);
            Route::post('/tambah', [KeadanOrangTuaController::class, 'store']);
            Route::post('/{id}/ubah', [KeadanOrangTuaController::class, 'update']);
            Route::delete('/{id}/hapus', [KeadanOrangTuaController::class, 'destroy']);
        });
        Route::prefix('penerimaan-bantuan-sosial')->group(function () {
            Route::get('', [PenerimaanBantuanSosialController::class, 'all']);
            Route::get('/{id}', [PenerimaanBantuanSosialController::class, 'show']);
            Route::post('/tambah', [PenerimaanBantuanSosialController::class, 'store']);
            Route::post('/{id}/ubah', [PenerimaanBantuanSosialController::class, 'update']);
            Route::delete('/{id}/hapus', [PenerimaanBantuanSosialController::class, 'destroy']);
        });
        Route::prefix('status-dalam-keluarga')->group(function () {
            Route::get('', [StatusDalamKeluargaController::class, 'all']);
            Route::get('/{id}', [StatusDalamKeluargaController::class, 'show']);
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
            Route::get('/{id}', [StatusKepemilikanRumahController::class, 'show']);
            Route::post('/tambah', [StatusKepemilikanRumahController::class, 'store']);
            Route::post('/{id}/ubah', [StatusKepemilikanRumahController::class, 'update']);
            Route::delete('/{id}/hapus', [StatusKepemilikanRumahController::class, 'destroy']);
        });
        Route::prefix('status-tinggal-bersama')->group(function () {
            Route::get('', [TinggalBersamaController::class, 'all']);
            Route::get('/{id}', [TinggalBersamaController::class, 'show']);
            Route::post('/tambah', [TinggalBersamaController::class, 'store']);
            Route::post('/{id}/ubah', [TinggalBersamaController::class, 'update']);
            Route::delete('/{id}/hapus', [TinggalBersamaController::class, 'destroy']);
        });
        Route::prefix('sumber-air')->group(function () {
            Route::get('', [SumberAirController::class, 'all']);
            Route::get('/{id}', [SumberAirController::class, 'show']);
            Route::post('/tambah', [SumberAirController::class, 'store']);
            Route::post('/{id}/ubah', [SumberAirController::class, 'update']);
            Route::delete('/{id}/hapus', [SumberAirController::class, 'destroy']);
        });
        Route::prefix('daya-listrik')->group(function () {
            Route::get('', [DayaListrikController::class, 'all']);
            Route::get('/{id}', [DayaListrikController::class, 'show']);
            Route::post('/tambah', [DayaListrikController::class, 'store']);
            Route::post('/{id}/ubah', [DayaListrikController::class, 'update']);
            Route::delete('/{id}/hapus', [DayaListrikController::class, 'destroy']);
        });
        Route::prefix('harta-tidak-bergerak')->group(function () {
            Route::get('', [HartaTidakBergerakController::class, 'all']);
            Route::get('/{id}', [HartaTidakBergerakController::class, 'show']);
            Route::post('/tambah', [HartaTidakBergerakController::class, 'store']);
            Route::post('/{id}/ubah', [HartaTidakBergerakController::class, 'update']);
            Route::delete('/{id}/hapus', [HartaTidakBergerakController::class, 'destroy']);
        });
        Route::prefix('status-harta-tidak-bergerak')->group(function () {
            Route::get('', [StatusHartaTidakBergerakController::class, 'all']);
            Route::get('/{id}', [StatusHartaTidakBergerakController::class, 'show']);
            Route::post('/tambah', [StatusHartaTidakBergerakController::class, 'store']);
            Route::post('/{id}/ubah', [StatusHartaTidakBergerakController::class, 'update']);
            Route::delete('/{id}/hapus', [StatusHartaTidakBergerakController::class, 'destroy']);
        });
        Route::prefix('kepemilikan-kendaraan')->group(function () {
            Route::get('', [KepemilikanKendaraanController::class, 'all']);
            Route::get('/{id}', [KepemilikanKendaraanController::class, 'show']);
            Route::post('/tambah', [KepemilikanKendaraanController::class, 'store']);
            Route::post('/{id}/ubah', [KepemilikanKendaraanController::class, 'update']);
            Route::delete('/{id}/hapus', [KepemilikanKendaraanController::class, 'destroy']);
        });
        Route::prefix('status-kepemilikan-kendaraan')->group(function () {
            Route::get('', [StatusKepemilikanKendaraanController::class, 'all']);
            Route::get('/{id}', [StatusKepemilikanKendaraanController::class, 'show']);
            Route::post('/tambah', [StatusKepemilikanKendaraanController::class, 'store']);
            Route::post('/{id}/ubah', [StatusKepemilikanKendaraanController::class, 'update']);
            Route::delete('/{id}/hapus', [StatusKepemilikanKendaraanController::class, 'destroy']);
        });
        Route::prefix('mandi-cuci-kakus')->group(function () {
            Route::get('', [MandiCuciKakusController::class, 'all']);
            Route::post('/tambah', [MandiCuciKakusController::class, 'store']);
            Route::post('/{id}/ubah', [MandiCuciKakusController::class, 'update']);
            Route::delete('/{id}/hapus', [MandiCuciKakusController::class, 'destroy']);
        });
        Route::prefix('golongan-darah')->group(function () {
            Route::get('', [GolonganDarahController::class, 'all']);
            Route::get('/{id}', [GolonganDarahController::class, 'show']);
            Route::post('/tambah', [GolonganDarahController::class, 'store']);
            Route::post('/{id}/ubah', [GolonganDarahController::class, 'update']);
            Route::delete('/{id}/hapus', [GolonganDarahController::class, 'destroy']);
        });
        Route::prefix('informasi-ppdb')->group(function () {
            Route::get('', [InformasiPpdbController::class, 'all']);
            Route::post('/tambah', [InformasiPpdbController::class, 'store']);
            Route::get('/{id}', [InformasiPpdbController::class, 'show']);
            Route::post('/{id}/ubah', [InformasiPpdbController::class, 'update']);
            Route::delete('/{id}/hapus', [InformasiPpdbController::class, 'destroy']);
        });
        Route::prefix('peserta-didik')->group(function () {
            Route::get('', [PesertaDidikController::class, 'all']);
            Route::get('/perhari', [PesertaDidikController::class, 'getPendaftarPerhari']);
            Route::get('/diterima', [PesertaDidikController::class, 'getPesertaDidikDiterima']);
            Route::get('/ditolak', [PesertaDidikController::class, 'getPesertaDidikDitolak']);
            Route::get('/proses', [PesertaDidikController::class, 'getPesertaDidikDiproses']);
            Route::get('/proses/{id}/validasi', [PesertaDidikController::class, 'getPesertaDidikValidasiProses']);
            Route::post('/proses/{id}/validasi/diterima', [PesertaDidikController::class, 'getPesertaDidikValidasiProsesTerima']);
            Route::post('/proses/{id}/validasi/ditolak', [PesertaDidikController::class, 'getPesertaDidikValidasiProsesTolak']);
            // Route::post('/tambah', [PesertaDidikController::class, 'store']);
            // Route::post('/{id}/ubah', [PesertaDidikController::class, 'update']);
            // Route::delete('/{id}/hapus', [PesertaDidikController::class, 'destroy']);
        });
        Route::prefix('peserta')->group(function () {
            Route::post('/diterima-export', [ExcelPesertaDidikController::class, 'getPesertaDidikDiDiterimaExport']);
        });

        Route::prefix('mandi-cuci-kakus')->group(function () {
            Route::get('', [MandiCuciKakusController::class, 'all']);
            Route::get('/{id}', [MandiCuciKakusController::class, 'show']);
            Route::post('/tambah', [MandiCuciKakusController::class, 'store']);
            Route::post('/{id}/ubah', [MandiCuciKakusController::class, 'update']);
            Route::delete('/{id}/hapus', [MandiCuciKakusController::class, 'destroy']);
        });
        Route::prefix('luas-tanah')->group(function () {
            Route::get('', [LuasTanahController::class, 'all']);
            Route::get('/{id}', [LuasTanahController::class, 'show']);
            Route::post('/tambah', [LuasTanahController::class, 'store']);
            Route::post('/{id}/ubah', [LuasTanahController::class, 'update']);
            Route::delete('/{id}/hapus', [LuasTanahController::class, 'destroy']);
        });
        Route::prefix('kualitas-rumah')->group(function () {
            Route::get('', [KualitaRumahController::class, 'all']);
            Route::get('/{id}', [KualitaRumahController::class, 'show']);
            Route::post('/tambah', [KualitaRumahController::class, 'store']);
            Route::post('/{id}/ubah', [KualitaRumahController::class, 'update']);
            Route::delete('/{id}/hapus', [KualitaRumahController::class, 'destroy']);
        });
        Route::prefix('banner')->group(function () {
            Route::get('', [BannerPendaftaranController::class, 'all']);
            Route::post('/tambah', [BannerPendaftaranController::class, 'store']);
            Route::delete('/{id}/hapus', [BannerPendaftaranController::class, 'destroy']);
        });
    });
});



