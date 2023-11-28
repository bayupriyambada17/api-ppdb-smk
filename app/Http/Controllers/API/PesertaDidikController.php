<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\PesertaDidikModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Database\Eloquent\Builder;

class PesertaDidikController extends Controller
{
    public function getPendaftarPerhari()
    {
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $this->getRegistrationsData(), 200);
    }
    public function all()
    {
        $results = collect();

        PesertaDidikModel::with(['tahunPelajaran:id,tahun_pelajaran',
            'tahunLulus:id,tahun',
            'provinsi:id,name',
            'rapor',
            'fasilitator',
            'fasilitas',
            'riwayatPenyakit',
            'keadaanOrangTua:id,status',
            'statusDalamKeluarga:id,status',
            'tinggalBersamaOrangTua:id,status',
            'uploadDokumen',
            'penerimaanBantuanSosial:id,status',
            'sumberPenghasilan:id,status'
        ])->orderBy('tanggal_terdaftar', 'desc')->chunk(200, function ($pesertaDidik) use ($results) {
            $results->push($pesertaDidik);
        });
        // $pesertaDidik = PesertaDidikModel::with(['provinsi',
        //     'rapor',
        //     'fasilitator',
        //     'fasilitas',
        //     'riwayatPenyakit',
        //     'uploadDokumen'
        // ])->orderBy('tanggal_terdaftar', 'desc')->get();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $results, 200);
    }
    private function getRegistrationsData(): array
    {
        $today = now();

        $createQuery = function (Builder $query, $daysAgo) use ($today) {
            return $query
                ->whereDate("tanggal_terdaftar", '>=', $today->subDays($daysAgo))
                ->whereDate("tanggal_terdaftar", '<=', $today)
                ->orderBy("tanggal_terdaftar", "desc")
                ->select(
                    'tahun_pelajaran_id',
                    'nomor_pendaftar',
                    'nama_lengkap',
                    'nik',
                    'tanggal_terdaftar'
                )
                ->with(["tahunPelajaran:id,tahun_pelajaran"])
                ->limit(20);
        };

        // Mendapatkan data per hari ini
        $todayQuery = $createQuery(clone PesertaDidikModel::query(), 0);
        $data['harian'] = [
            'total_jumlah' => $todayQuery->count(),
            'peserta_terdaftar' => $todayQuery->get()
        ];

        // Mendapatkan data 7 hari yang lalu
        $sevenDaysQuery = $createQuery(clone PesertaDidikModel::query(), 7);
        $data['tujuh'] = [
            'total_jumlah' => $sevenDaysQuery->count(),
            'peserta_terdaftar' => $sevenDaysQuery->get()
        ];

        // Mendapatkan data 14 hari yang lalu
        $fourteenDaysQuery = $createQuery(clone PesertaDidikModel::query(), 14);
        $data['empatbelas'] = [
            'total_jumlah' => $fourteenDaysQuery->count(),
            'peserta_terdaftar' => $fourteenDaysQuery->get()
        ];

        return $data;
    }
}
