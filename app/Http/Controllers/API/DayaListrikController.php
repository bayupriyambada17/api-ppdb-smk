<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\DayaListrikModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;

class DayaListrikController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');
            if ($id) {
                $dayaListrikId = DayaListrikModel::find($id);
                if ($dayaListrikId) {
                    return NotificationStatus::notifSuccess(
                        true,
                        ConstantaHelper::DataId,
                        $dayaListrikId,
                        200
                    );
                } else {
                    return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
                }
            }

            $dayaListrik = DayaListrikModel::query();
            if ($status) {
                $dayaListrik->where('status', 'LIKE', '%' . $status . '%');
            }

            return NotificationStatus::notifSuccess(
                true,
                ConstantaHelper::DataDiambil,
                $dayaListrik->latest()->get(),
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

            $dayaListrik = DayaListrikModel::create([
                'status' => $request->status,
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, $dayaListrik, 200);
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
        $dayaListrikId = DayaListrikModel::where("id", $id)->first();
        if (!$dayaListrikId) {
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

        $dayaListrikId->update([
            'status' => $request->status,
        ]);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $dayaListrikId, 200);
    }

    public function destroy(string $id)
    {
        $dayaListrikId = DayaListrikModel::where("id", $id)->first();
        if (!$dayaListrikId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $dayaListrikId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTelahTerhapus, null, 200);
    }
}
