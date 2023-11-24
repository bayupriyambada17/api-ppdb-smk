<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;
use App\Models\StatusKepemilikanRumahModel;

class StatusKepemilikanRumahController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');
            if ($id) {
                $statusKepemilikanRumahId = StatusKepemilikanRumahModel::find($id);
                if ($statusKepemilikanRumahId) {
                    return NotificationStatus::notifSuccess(
                        true,
                        ConstantaHelper::DataId,
                        $statusKepemilikanRumahId,
                        200
                    );
                } else {
                    return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
                }
            }

            $statusKepemilikanRumah = StatusKepemilikanRumahModel::query();
            if ($status) {
                $statusKepemilikanRumah->where('status', 'LIKE', '%' . $status . '%');
            }
            return NotificationStatus::notifSuccess(
                true,
                ConstantaHelper::DataDiambil,
                $statusKepemilikanRumah->latest()->get(),
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

            $statusKepemilikanRumah = StatusKepemilikanRumahModel::create([
                'status' => $request->status,
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, $statusKepemilikanRumah, 200);
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
        $statusKepemilikanRumahId = StatusKepemilikanRumahModel::where("id", $id)->first();
        if (!$statusKepemilikanRumahId) {
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

        $statusKepemilikanRumahId->update([
            'status' => $request->status,
        ]);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $statusKepemilikanRumahId, 200);
    }

    public function destroy(string $id)
    {
        $statusKepemilikanRumahId = StatusKepemilikanRumahModel::where("id", $id)->first();
        if (!$statusKepemilikanRumahId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $statusKepemilikanRumahId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTelahTerhapus, null, 200);
    }
}
