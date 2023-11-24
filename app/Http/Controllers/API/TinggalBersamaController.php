<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\NotificationStatus;
use App\Models\TinggalBersamaStatusModel;
use Illuminate\Support\Facades\Validator;

class TinggalBersamaController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->query('status');
            if ($id) {
                $tinggalBersamaId = TinggalBersamaStatusModel::find($id);
                if ($tinggalBersamaId) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Berhasil Mengambil dengan Id: ' . $tinggalBersamaId->id,
                        'data' => $tinggalBersamaId
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Tidak menemukan id',
                        'data' => null
                    ]);
                }
            }

            $tinggalBersamaStatus = TinggalBersamaStatusModel::query();

            if ($status) {
                $tinggalBersamaStatus->where("status", 'LIKE', '%' . $status . '%');
            }

            return response()->json([
                'status' => true,
                'message' => "Data berhasil diambil",
                'data' => $tinggalBersamaStatus->latest()->get()
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

            $tinggalBersamaStatus = TinggalBersamaStatusModel::create([
                'status' => $request->status,
            ]);
            return response()->json([
                'status' => true,
                'message' => $tinggalBersamaStatus->status . " berhasil ditambahkan!",
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
        $tinggalBersamaId = TinggalBersamaStatusModel::where("id", $id)->first();
        if (!$tinggalBersamaId) {
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

        $tinggalBersamaId->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Data berhasil di ubah!",
        ]);
    }

    public function destroy(string $id)
    {
        $tinggalBersamaId = TinggalBersamaStatusModel::where("id", $id)->first();
        if (!$tinggalBersamaId) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak menemukan tahun id',
            ]);
        }
        $tinggalBersamaId->delete();
        return response()->json([
            'status' => true,
            'message' => "Data berhasil dihapus!",
        ]);
    }
}
