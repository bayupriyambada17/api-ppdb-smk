<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Models\SumberPenghasilanModel;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;

class SumberPenghasilanController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');
            if ($id) {
                $sumberPenghasilanId = SumberPenghasilanModel::find($id);
                if ($sumberPenghasilanId) {
                    return NotificationStatus::notifSuccess(
                        true,
                        ConstantaHelper::DataId,
                        $sumberPenghasilanId,
                        200
                    );
                } else {
                    return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
                }
            }

            $sumberPenghasilan = SumberPenghasilanModel::query();
            if ($status) {
                $sumberPenghasilan->where('status', 'LIKE', '%' . $status . '%');
            }

            return NotificationStatus::notifSuccess(
                true,
                ConstantaHelper::DataDiambil,
                $sumberPenghasilan->latest()->get(),
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

            $sumberPenghasilan = SumberPenghasilanModel::create([
                'status' => $request->status,
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, $sumberPenghasilan, 200);
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
        $sumberPenghasilanId = SumberPenghasilanModel::where("id", $id)->first();
        if (!$sumberPenghasilanId) {
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

        $sumberPenghasilanId->update([
            'status' => $request->status,
        ]);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $sumberPenghasilanId, 200);
    }

    public function destroy(string $id)
    {
        $sumberPenghasilanId = SumberPenghasilanModel::where("id", $id)->first();
        if (!$sumberPenghasilanId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $sumberPenghasilanId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTelahTerhapus, null, 200);
    }
}
