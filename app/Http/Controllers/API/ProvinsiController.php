<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ProvinsiModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;

class ProvinsiController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $name = $request->input('name');
            if ($id) {
                $provinsiId = ProvinsiModel::find($id);
                if ($provinsiId) {
                    return NotificationStatus::notifSuccess(
                        true,
                        ConstantaHelper::DataId,
                        $provinsiId,
                        200
                    );
                } else {
                    return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
                }
            }

            $provinsi = ProvinsiModel::query();
            if ($name) {
                $provinsi->where('name', 'LIKE', '%' . $name . '%');
            }

            return NotificationStatus::notifSuccess(
                true,
                ConstantaHelper::DataDiambil,
                $provinsi->latest()->get(),
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
        $dataId = ProvinsiModel::where("id", $id)->first();
        if (!$dataId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        } else {
            return NotificationStatus::notifSuccess(false, ConstantaHelper::DataId, $dataId, 200);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => ConstantaHelper::ValidationError,
                    'errors' => $validator->errors()
                ], 401);
            }

            $provinsi = ProvinsiModel::create([
                'name' => $request->name,
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, $provinsi, 200);
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
        $provinsiId = ProvinsiModel::where("id", $id)->first();
        if (!$provinsiId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }

        $provinsiId->update([
            'name' => $request->name,
        ]);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $provinsiId, 200);
    }

    public function destroy(string $id)
    {
        $provinsiId = ProvinsiModel::where("id", $id)->first();
        if (!$provinsiId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $provinsiId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTelahTerhapus, null, 200);
    }
}
