<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Models\PesertaDidikModel;
use Illuminate\Support\Facades\DB;
use App\Models\TahunPelajaranModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Database\Eloquent\Builder;

class DataDashboardController extends Controller
{

    public function getPesertaDidikCount()
    {
        $diproses = PesertaDidikModel::where("is_pendaftar", 'proses')->count();
        $ditolak = PesertaDidikModel::where("is_pendaftar", 'ditolak')->count();
        $diterima = PesertaDidikModel::where("is_pendaftar", 'diterima')->count();

        $data = [
            "proses" => $diproses,
            "diterima" => $diterima,
            "ditolak" => $ditolak,
        ];

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $data, 200);
    }
    public function getDataPesertaPerhari()
    {
        $data = [];

        PesertaDidikModel::whereDate("tanggal_terdaftar", today())
            ->with('tahunPelajaran:id,tahun_pelajaran')
        ->select("id", 'tahun_pelajaran_id', 'nomor_pendaftar', 'nama_lengkap', 'tanggal_terdaftar')
        ->orderByDesc('tanggal_terdaftar')
        ->chunk(100, function ($perhari) use (&$data) {
            $data[] = [
                'total_jumlah' => count($perhari),
                'perhari' => $perhari->toArray(),
            ];
        });
        $result = array_merge(...$data);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $result, 200);
    }
    public function getPesertaDaftarHarian()
    {
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $this->getRegistrationsData(), 200);
    }
    public function getTotalPesertaDidik()
    {
        $total = TahunPelajaranModel::select('id', 'tahun_pelajaran', 'is_active')->withCount('pesertaDidik')->get();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $total, 200);
    }
    public function getProvinsi()
    {
        $data = TahunPelajaranModel::with(['pesertaDidik' => function ($query) {
            $query->leftJoin(
                'provinsi',
                'peserta_didik.provinsi_id',
                '=',
                'provinsi.id'
            )
                ->select('peserta_didik.*', 'provinsi.name as provinsi_name');
        }])
            ->get()
            ->map(function ($tahunPelajaran) {
                return [
                    'tahun_pelajaran' => $tahunPelajaran->tahun_pelajaran,
                    'provinsi_data' => $tahunPelajaran->pesertaDidik->groupBy('provinsi_name')
                    ->map(function ($groupedProvinsi) {
                        return $groupedProvinsi->count();
                    })
                ];
            });

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $data, 200);
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
            ->limit(10);
        };

        // Mendapatkan data per hari ini
        $todayQuery = $createQuery(clone PesertaDidikModel::query(), 0);
        $data['harian'] = [
            'total_jumlah' => $todayQuery->count(),
            'peserta_terdaftar' => $todayQuery->latest()->limit(10)->get()
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
