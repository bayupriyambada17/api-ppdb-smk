<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\TahunLulusModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;

class TahunLulusController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $tahun = $request->query('tahun');
            $is_active  = $request->input('is_active');
            if ($id) {
                $tahunId = TahunLulusModel::find($id);
                if ($tahunId) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Berhasil Mengambil dengan Id: ' . $tahunId->id,
                        'data' => $tahunId
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Tidak menemukan tahun id',
                        'data' => null
                    ]);
                }
            }

            $tahunLulus = TahunLulusModel::query();
            if ($tahun) {
                $tahunLulus->where('tahun', 'LIKE', '%' . $tahun . '%');
            }

            if ($is_active) {
                $tahunLulus->where('is_active', '=', $is_active);
            }

            return response()->json([
                'status' => true,
                'message' => "Tahun lulus berhasil diambil",
                'data' => $tahunLulus->latest()->get()
            ]);
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
                'tahun' => 'required',
                'is_active' => 'required|boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            $tahunLulus = TahunLulusModel::create([
                'tahun' => $request->tahun,
                'is_active' => $request->is_active
            ]);
            return response()->json([
                'status' => true,
                'message' => "Tahun Lulus " . $tahunLulus->tahun . " berhasil ditambahkan!",
            ]);
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
        $dataId = TahunLulusModel::where('id', $id)->first();
        if (!$dataId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        } else {
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataId, $dataId, 200);
        }
    }

    public function update(Request $request, string $id)
    {
        $tahunLulusId = TahunLulusModel::where("id", $id)->first();
        if (!$tahunLulusId) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak menemukan tahun id',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'tahun' => 'required',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 401);
        }

        $tahunLulusId->update([
            'tahun' => $request->tahun,
            'is_active' => $request->is_active,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Tahun Lulus berhasil di ubah!",
        ]);
    }

    public function destroy(string $id)
    {
        $tahunLulusId = TahunLulusModel::where("id", $id)->first();
        if (!$tahunLulusId) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak menemukan tahun id',
            ]);
        }
        $tahunLulusId->delete();
        return response()->json([
            'status' => true,
            'message' => "Tahun Lulus berhasil dihapus!",
        ]);
    }
}
