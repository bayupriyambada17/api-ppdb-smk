<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Models\KepemilikanKendaraanModel;
use Illuminate\Support\Facades\Validator;

class KepemilikanKendaraanController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');
            if ($id) {
                $kepemilikanKendaraanId = KepemilikanKendaraanModel::find($id);
                if ($kepemilikanKendaraanId) {
                    return NotificationStatus::notifSuccess(
                        true,
                        ConstantaHelper::DataId,
                        $kepemilikanKendaraanId,
                        200
                    );
                } else {
                    return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
                }
            }

            $kepemilikanKendaraan = KepemilikanKendaraanModel::query();
            if ($status) {
                $kepemilikanKendaraan->where('status', 'LIKE', '%' . $status . '%');
            }

            return NotificationStatus::notifSuccess(
                true,
                ConstantaHelper::DataDiambil,
                $kepemilikanKendaraan->latest()->get(),
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
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => ConstantaHelper::ValidationError,
                    'errors' => $validator->errors()
                ], 401);
            }

            $madiCuciKakus = KepemilikanKendaraanModel::create([
                'status' => $request->status,
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, $madiCuciKakus, 200);
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
        $kepemilikanKendaraanId = KepemilikanKendaraanModel::where("id", $id)->first();
        if (!$kepemilikanKendaraanId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }

        $kepemilikanKendaraanId->update([
            'status' => $request->status,
        ]);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $kepemilikanKendaraanId, 200);
    }

    public function destroy(string $id)
    {
        $kepemilikanKendaraanId = KepemilikanKendaraanModel::where("id", $id)->first();
        if (!$kepemilikanKendaraanId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $kepemilikanKendaraanId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTelahTerhapus, null, 200);
    }
}
