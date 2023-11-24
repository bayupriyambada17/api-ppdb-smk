<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KeadaanOrangTuaModel;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\NotificationStatus;

class KeadanOrangTuaController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->query('status');
            if ($id) {
                $keaadaanOrangTuaId = KeadaanOrangTuaModel::find($id);
                if ($keaadaanOrangTuaId) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Berhasil Mengambil dengan Id: ' . $keaadaanOrangTuaId->id,
                        'data' => $keaadaanOrangTuaId
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Tidak menemukan id',
                        'data' => null
                    ]);
                }
            }

            $keaadaanOrangTua = KeadaanOrangTuaModel::query();

            if ($status) {
                $keaadaanOrangTua->where("status", 'LIKE', '%' . $status . '%');
            }

            return response()->json([
                'status' => true,
                'message' => "Data berhasil diambil",
                'data' => $keaadaanOrangTua->latest()->get()
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
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validator->errors()
                ], 401);
            }

            $keaadaanOrangTua = KeadaanOrangTuaModel::create([
                'status' => $request->status,
            ]);
            return response()->json([
                'status' => true,
                'message' => $keaadaanOrangTua->status . " berhasil ditambahkan!",
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
        $keadaanOrangTuaId = KeadaanOrangTuaModel::where("id", $id)->first();
        if (!$keadaanOrangTuaId) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak menemukan tahun id',
            ]);
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

        $keadaanOrangTuaId->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Data berhasil di ubah!",
        ]);
    }

    public function destroy(string $id)
    {
        $keadaanOrangTuaId = KeadaanOrangTuaModel::where("id", $id)->first();
        if (!$keadaanOrangTuaId) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak menemukan tahun id',
            ]);
        }
        $keadaanOrangTuaId->delete();
        return response()->json([
            'status' => true,
            'message' => "Data berhasil dihapus!",
        ]);
    }
}
