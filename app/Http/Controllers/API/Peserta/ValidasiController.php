<?php

namespace App\Http\Controllers\API\Peserta;

use Illuminate\Http\Request;
use App\Models\PesertaDidikModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;

class ValidasiController extends Controller
{
    public function getPesertaDidikDiproses()
    {
        list($nomorPendaftar, $nik, $nisn, $namaLengkap) = $this->requestFiltering();
        $data = PesertaDidikModel::with('tahunPelajaran:id,tahun_pelajaran')
            ->select($this->selectOption())
            ->where($this->queryFiltering($nomorPendaftar, $nik, $namaLengkap, $nisn))
            ->where("is_pendaftar", "proses")
            ->orderBy('tanggal_terdaftar', 'desc')->paginate(10);
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $data, 200);
    }
    public function getPesertaDidikDiterima()
    {
        list($nomorPendaftar, $nik, $nisn, $namaLengkap) = $this->requestFiltering();
        $data = PesertaDidikModel::with('tahunPelajaran:id,tahun_pelajaran')
            ->select($this->selectOption())
            ->where($this->queryFiltering($nomorPendaftar, $nik, $namaLengkap, $nisn))
            ->where("is_pendaftar", "diterima")
            ->orderBy('tanggal_terdaftar', 'desc')->paginate(10);
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $data, 200);
    }
    public function getPesertaDidikDitolak()
    {
        list($nomorPendaftar, $nik, $nisn, $namaLengkap) = $this->requestFiltering();
        $data = PesertaDidikModel::with('tahunPelajaran:id,tahun_pelajaran')
            ->select($this->selectOption())
            ->where($this->queryFiltering($nomorPendaftar, $nik, $namaLengkap, $nisn))
            ->where("is_pendaftar", "ditolak")
            ->orderBy('tanggal_terdaftar', 'desc')->paginate(10);
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $data, 200);
    }
    private function requestFiltering()
    {
        $nomorPendaftar = request()->input('nomor_pendaftar');
        $nik = request()->input('nik');
        $nisn = request()->input('nisn');
        $namaLengkap = request()->input('nama_lengkap');
        return [$namaLengkap, $nik, $nisn, $nomorPendaftar];
    }

    private function queryFiltering($nomorPendaftar, $nik, $namaLengkap, $nisn)
    {
        return
            function ($query) use ($nomorPendaftar, $nik, $namaLengkap, $nisn) {
                if ($nomorPendaftar) $query->where("nomor_pendaftar", "LIKE", "%" . $nomorPendaftar . "%");
                if ($nik) $query->where("nik", "LIKE", "%" . $nik . "%");
                if ($nisn) $query->where("nisn", "LIKE", "%" . $nisn . "%");
                if ($namaLengkap) $query->where("nama_lengkap", "LIKE", "%" . $namaLengkap . "%");
            };
    }

    private function selectOption()
    {
        return ["id", 'tahun_pelajaran_id', 'nomor_pendaftar', 'nik', 'nisn', 'nama_lengkap', 'tanggal_terdaftar', 'is_pendaftar'];
    }
}
