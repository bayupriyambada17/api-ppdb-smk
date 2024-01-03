<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\ValidatorMessageHelper;
use Illuminate\Database\Eloquent\Model;

class ModelHelper
{
    public static function getAll($model, $withCountRelationships, $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->input('status');
            $data = $model::query();

            if ($status) {
                $data->where('status', 'LIKE', '%' . $status . '%');
            }

            foreach ($withCountRelationships as $relationship) {
                $data->withCount([$relationship]);
            }

            return NotificationStatus::notifSuccess(
                true,
                ConstantaHelper::DataDiambil,
                $data->latest()->get(),
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
    public static function store($model, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
            ], ValidatorMessageHelper::validator());

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $data = $model::create([
                'status' => $request->status,
            ]);
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, $data, 200);
        } catch (\Exception $e) {
            return NotificationStatus::notifError(
                false,
                $e->getMessage(),
                null,
                500
            );
        }
    }

    public static function show($model, string $id)
    {
        $dataId = $model::where("id", $id)->first();
        if (!$dataId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataId, $dataId, 200);
    }

    public static function update($model, Request $request, string $id)
    {
        $dataId = $model::where("id", $id)->first();
        if (!$dataId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ], ValidatorMessageHelper::validator());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $dataId->update([
            'status' => $request->status,
        ]);

        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiperbaharui, $dataId, 200);
    }

    public static function destroy($model, $existsModelData, $existsWhereDelete, string $id)
    {
        $dataId = $model::where("id", $id)->first();
        if (!$dataId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        $relation = $existsModelData::where($existsWhereDelete, $dataId->id)->first();
        if ($relation) {
            return NotificationStatus::notifError(false, ConstantaHelper::DataBerelasi, null, 400);
        } else {
            $dataId->delete();
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTerhapus, null, 200);
        }
    }
}
