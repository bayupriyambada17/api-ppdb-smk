<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StatusDalamKeluargaModel;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\NotificationStatus;

class StatusDalamKeluargaController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->query('status');
            if ($id) {
                $statusDalamKeluargaId = StatusDalamKeluargaModel::find($id);
                if ($statusDalamKeluargaId) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Berhasil Mengambil dengan Id: ' . $statusDalamKeluargaId->id,
                        'data' => $statusDalamKeluargaId
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Tidak menemukan id',
                        'data' => null
                    ]);
                }
            }

            $statusDalamKeluarga = StatusDalamKeluargaModel::query();

            if ($status) {
                $statusDalamKeluarga->where("status", 'LIKE', '%' . $status . '%');
            }

            return response()->json([
                'status' => true,
                'message' => "Data berhasil diambil",
                'data' => $statusDalamKeluarga->latest()->get()
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

            $statusDalamKeluarga = StatusDalamKeluargaModel::create([
                'status' => $request->status,
            ]);
            return response()->json([
                'status' => true,
                'message' => $statusDalamKeluarga->status . " berhasil ditambahkan!",
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
        $statusDalamKeluarga = StatusDalamKeluargaModel::where("id", $id)->first();
        if (!$statusDalamKeluarga) {
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

        $statusDalamKeluarga->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Data berhasil di ubah!",
        ]);
    }

    public function destroy(string $id)
    {
        $statusDalamKeluargaId = StatusDalamKeluargaModel::where("id", $id)->first();
        if (!$statusDalamKeluargaId) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak menemukan tahun id',
            ]);
        }
        $statusDalamKeluargaId->delete();
        return response()->json([
            'status' => true,
            'message' => "Data berhasil dihapus!",
        ]);
    }
}
