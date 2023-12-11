<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Http\Resources\TahunPelajaranGetPesertaResource;
use App\Models\PesertaDidikModel;
use App\Models\TahunPelajaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunPengajaranController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $tahun_pelajaran = $request->input('tahun_pelajaran');
            $isActive  = $request->input('is_active');
            if ($id) {
                $tahunId = TahunPelajaranModel::find($id);
                if ($tahunId) {
                    return NotificationStatus::notifSuccess(
                        true,
                        ConstantaHelper::DataId,
                        $tahunId,
                        200
                    );
                } else {
                    return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
                }
            }

            $tahunPelajaran = TahunPelajaranModel::query();
            if ($tahun_pelajaran) {
                $tahunPelajaran->where('tahun_pelajaran', 'LIKE', '%' . $tahun_pelajaran . '%');
            }

            if ($isActive) {
                $tahunPelajaran->where('is_active', '=', $isActive);
            }

            return NotificationStatus::notifSuccess(
                true,
                ConstantaHelper::DataDiambil,
                $tahunPelajaran->latest()->get(),
                200
            );
        } catch (\Exception $e) {
            return NotificationStatus::notifError(
                false,
                $e->getMessage(),
                null,
                500
            );
        }
    }

    public function show(string $id)
    {
        try {
            $viewId = TahunPelajaranModel::where("id", $id)->first();
            if (!$viewId) {
                return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
            }
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataId, $viewId, 200);
        } catch (\Exception $e) {
            return NotificationStatus::notifError(true, $e->getMessage(), null, 500);
        }
    }

    public function showPesertaDidikPelajaran(string $id)
    {
        $namaLengkap = request()->input('nama_lengkap');
        $nik = request()->input('nik');
        $provinsi = request()->input('provinsi');
        $lihatPesertaPelajaranId = new TahunPelajaranGetPesertaResource(
            TahunPelajaranModel::with(['pesertaDidik' => function ($query) use ($namaLengkap, $nik, $provinsi) {
                $query->where("is_pendaftar", "diterima");
                if ($namaLengkap) {
                    $query->where('nama_lengkap', 'like', '%' . $namaLengkap . '%');
                }
                if ($nik) {
                    $query->where('nik', 'like', '%' . $nik . '%');
                }
                if ($provinsi) {
                    $query->whereHas('provinsi', function ($subQuery) use ($provinsi) {
                        $subQuery->where('name', 'like', '%' . $provinsi . '%');
                    });
                }
            }])->find($id)
        );
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataId, $lihatPesertaPelajaranId, 200);
    }

    public function viewTahunAjaran(string $id)
    {
        try {
            $viewTahunAjaranId = TahunPelajaranModel::with([
                'pesertaDidik.statusDalamKeluarga',
                'pesertaDidik.keadaanOrangTua',
                'pesertaDidik.provinsi',
                'pesertaDidik.rapor',
                'pesertaDidik.fasilitator',
                'pesertaDidik.fasilitator.informasiPpdb',
                'pesertaDidik.fasilitas.statusKepemilikanRumah',
                'pesertaDidik.fasilitas.kualitasRumah',
                'pesertaDidik.fasilitas.luasTanah',
                'pesertaDidik.fasilitas.mandiCuciKakus',
                'pesertaDidik.fasilitas.sumberAir',
                'pesertaDidik.fasilitas.dayaListrik',
                'pesertaDidik.fasilitas.hartaTidakBergerak',
                'pesertaDidik.fasilitas.statusKepemilikanHtb',
                'pesertaDidik.fasilitas.kepemilikanKendaraan',
                'pesertaDidik.fasilitas.statusKepemilikanKendaraan',
                'pesertaDidik.riwayatPenyakit',
                'pesertaDidik.riwayatPenyakit.golonganDarah',
                'pesertaDidik.tahunLulus',
                'pesertaDidik.penerimaanBantuanSosial',
                'pesertaDidik.sumberPenghasilan',
            ])->where("id", $id)->first();
            if (!$viewTahunAjaranId) {
                return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
            } else {
                return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $viewTahunAjaranId, 200);
            }
        } catch (\Exception $e) {
            return NotificationStatus::notifError(false, $e->getMessage(), null, 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tahun_pelajaran' => 'required',
                'is_active' => 'required|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => ConstantaHelper::ValidationError,
                    'errors' => $validator->errors()
                ], 401);
            }

            $tahunPelajaran = TahunPelajaranModel::create([
                'tahun_pelajaran' => $request->tahun_pelajaran,
                'is_active' => $request->is_active
            ]);

            if ($tahunPelajaran->is_active) {
                TahunPelajaranModel::where('id', '<>', $tahunPelajaran->id)->update(['is_active' => 0]);
            }

            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, $tahunPelajaran, 200);
        } catch (\Exception $e) {
            return NotificationStatus::notifError(
                false,
                $e->getMessage(),
                null,
                500
            );
        }
    }

    public function update(Request $request, string $id)
    {
        $tahunPelajaranId = TahunPelajaranModel::where("id", $id)->first();
        if (!$tahunPelajaranId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }

        $validator = Validator::make($request->all(), [
            'tahun_pelajaran' => 'required',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }

        $tahunPelajaranId->update([
            'tahun_pelajaran' => $request->tahun_pelajaran,
            'is_active' => $request->is_active,
        ]);

        if ($request->is_active == 1) {
            TahunPelajaranModel::where('id', '<>', $id)->update(['is_active' => 0]);
        }

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $tahunPelajaranId, 200);
    }

    public function destroy(string $id)
    {
        $tahunPelajaranId = TahunPelajaranModel::where("id", $id)->first();

        if (!$tahunPelajaranId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $pesertaDidikTahunPelajaran = PesertaDidikModel::where("tahun_pelajaran_id", $tahunPelajaranId->id)->first();

        if ($pesertaDidikTahunPelajaran) {
            return NotificationStatus::notifError(false, ConstantaHelper::DataBerelasi, null, 400);
        } else {
            $deleted = $tahunPelajaranId->delete();
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTerhapus, null, 200);
        }


    }
}
