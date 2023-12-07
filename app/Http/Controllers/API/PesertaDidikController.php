<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PesertaDidikModel;
use App\Exports\PesertaDidikExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Http\Resources\PesertaDidikResource;
use Illuminate\Database\Eloquent\Builder;

class PesertaDidikController extends Controller
{
    public function getPendaftarPerhari()
    {
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $this->getRegistrationsData(), 200);
    }
    public function getPesertaDidikDiterima()
    {
        $data = PesertaDidikModel::with('tahunPelajaran:id,tahun_pelajaran')
        ->select("id", 'tahun_pelajaran_id', 'nomor_pendaftar', 'nama_lengkap', 'tanggal_terdaftar', 'is_pendaftar')
        ->where("is_pendaftar", "diterima")
        ->orderBy('tanggal_terdaftar', 'desc')->get();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $data, 200);
    }
    public function getPesertaDidikDitolak()
    {
        $data = PesertaDidikModel::with('tahunPelajaran:id,tahun_pelajaran')
        ->select("id", 'tahun_pelajaran_id', 'nomor_pendaftar', 'nama_lengkap', 'tanggal_terdaftar', 'is_pendaftar')
        ->where("is_pendaftar", "ditolak")
        ->orderBy('tanggal_terdaftar', 'desc')->get();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $data, 200);
    }

    public function getPesertaDidikValidasiProses(string $id)
    {
        $pesertaIdValidasi = new PesertaDidikResource(PesertaDidikModel::where('is_pendaftar', "proses")->where("id", $id)->first());
        if (!$pesertaIdValidasi) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        } else {
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataId, $pesertaIdValidasi, 200);
        }
    }
    public function getPesertaDidikValidasiProsesTerima(string $id)
    {
        $pesertaValidasiTerima = PesertaDidikModel::where("is_pendaftar", "proses")->where("id", $id)->first();
        if (!$pesertaValidasiTerima) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        } else {
            $pesertaValidasiTerima->update([
                'is_pendaftar' => "diterima"
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $pesertaValidasiTerima, 200);
        }
    }
    public function getPesertaDidikValidasiProsesTolak(string $id)
    {
        $pesertaValidasiTerima = PesertaDidikModel::where("is_pendaftar", "proses")->where("id", $id)->first();
        if (!$pesertaValidasiTerima) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        } else {
            $pesertaValidasiTerima->update([
                'is_pendaftar' => "ditolak"
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $pesertaValidasiTerima, 200);
        }
    }
    public function getPesertaDidikDiProses()
    {
        $data = PesertaDidikModel::with('tahunPelajaran:id,tahun_pelajaran')
        ->select("id", 'tahun_pelajaran_id', 'nomor_pendaftar', 'nama_lengkap', 'tanggal_terdaftar', 'is_pendaftar')
        ->where("is_pendaftar", "proses")
            ->orderBy('tanggal_terdaftar', 'desc')->get();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $data, 200);
    }
    public function all()
    {
        $results = collect();

        PesertaDidikModel::with([
            'tahunPelajaran:id,tahun_pelajaran',
            'tahunLulus:id,tahun',
            'provinsi:id,name',
            'rapor',
            'fasilitator',
            'fasilitas',
            'riwayatPenyakit.golonganDarah',
            'keadaanOrangTua:id,status',
            'statusDalamKeluarga:id,status',
            'tinggalBersamaOrangTua:id,status',
            'uploadDokumen',
            'penerimaanBantuanSosial:id,status',
            'sumberPenghasilan:id,status'
        ])->orderBy('tanggal_terdaftar', 'desc')->chunk(200, function ($pesertaDidik) use ($results) {
            $results->push($pesertaDidik);
        });
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
