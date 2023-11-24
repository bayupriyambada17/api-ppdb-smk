<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\TahunLulusModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;

class TahunLulusController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $tahun = $request->query('tahun');
            $isActive  = $request->input('isActive');
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

            if ($isActive) {
                $tahunLulus->where('isActive', '=', $isActive);
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
                'isActive' => 'required|boolean'
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
                'isActive' => $request->isActive
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
            'isActive' => 'required|boolean'
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
            'isActive' => $request->isActive,
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
