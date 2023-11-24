<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Models\SumberAirModel;
use Illuminate\Support\Facades\Validator;

class SumberAirController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');
            if ($id) {
                $sumberAirId = SumberAirModel::find($id);
                if ($sumberAirId) {
                    return NotificationStatus::notifSuccess(
                        true,
                        ConstantaHelper::DataId,
                        $sumberAirId,
                        200
                    );
                } else {
                    return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
                }
            }

            $sumberAir = SumberAirModel::query();
            if ($status) {
                $sumberAir->where('status', 'LIKE', '%' . $status . '%');
            }

            return NotificationStatus::notifSuccess(
                true,
                ConstantaHelper::DataDiambil,
                $sumberAir->latest()->get(),
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

            $sumberAir = SumberAirModel::create([
                'status' => $request->status,
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, $sumberAir, 200);
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
        $sumberAirId = SumberAirModel::where("id", $id)->first();
        if (!$sumberAirId) {
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

        $sumberAirId->update([
            'status' => $request->status,
        ]);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $sumberAirId, 200);
    }

    public function destroy(string $id)
    {
        $sumberAirId = SumberAirModel::where("id", $id)->first();
        if (!$sumberAirId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $sumberAirId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTelahTerhapus, null, 200);
    }
}
