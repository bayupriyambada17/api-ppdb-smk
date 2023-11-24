<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
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
            $isActive  = $request->input('isActive');
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
                $tahunPelajaran->where('isActive', '=', $isActive);
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
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tahun_pelajaran' => 'required',
                'isActive' => 'required|boolean'
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
                'isActive' => $request->isActive
            ]);
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
            'isActive' => 'required|boolean'
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
            'isActive' => $request->isActive,
        ]);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $tahunPelajaranId, 200);
    }

    public function destroy(string $id)
    {
        $tahunPelajaranId = TahunPelajaranModel::where("id", $id)->first();
        if (!$tahunPelajaranId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $tahunPelajaranId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTelahTerhapus, null, 200);
    }
}
