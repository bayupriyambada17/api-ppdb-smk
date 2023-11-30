<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Models\ProvinsiModel;
use App\Models\PesertaDidikModel;
use App\Models\TahunPelajaranModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Database\Eloquent\Builder;

class DataDashboardController extends Controller
{

    public function getPesertaDaftarHarian()
    {
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $this->getRegistrationsData(), 200);
    }
    public function getTotalPesertaDidik()
    {
        $total = TahunPelajaranModel::select('id', 'tahun_pelajaran', 'isActive')->withCount('pesertaDidik')->get();
        return response()->json($total);
    }
    public function getProvinsi()
    {
        // $tahunPelajaran = TahunPelajaranModel::get();

        // // Misalnya, kita ambil tahun_pelajaran pertama dari hasil query tahunPelajaran
        // $year = $tahunPelajaran->first()->tahun_pelajaran;

        // $provinsi = ProvinsiModel::select('id', 'name')
        // ->withCount("pesertaDidik")
        // ->whereHas('tahunPelajaran', function ($query) use ($year) {
        //     $query->where('tahun_pelajaran', $year);
        // })
        //     ->get();

        // return response()->json($provinsi);

        $provinsi = ProvinsiModel::select('id', 'name')->withCount("pesertaDidik")->get();
        return response()->json($provinsi);
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
