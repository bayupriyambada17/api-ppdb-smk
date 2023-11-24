<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\PenerimaanBantuanSosialModel;
use App\Http\Helpers\NotificationStatus;

class PenerimaanBantuanSosialController extends Controller
{
    public function all(Request $request)
    {
        try {
            $id = $request->input('id');
            $status = $request->query('status');
            if ($id) {
                $penerimaBantuanSosialId = PenerimaanBantuanSosialModel::find($id);
                if ($penerimaBantuanSosialId) {
                    return response()->json([
                        'status' => true,
                        'message' => 'Berhasil Mengambil dengan Id: ' . $penerimaBantuanSosialId->id,
                        'data' => $penerimaBantuanSosialId
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Tidak menemukan id',
                        'data' => null
                    ]);
                }
            }

            $penerimaBantuanSosial = PenerimaanBantuanSosialModel::query();

            if ($status) {
                $penerimaBantuanSosial->where("status", 'LIKE', '%' . $status . '%');
            }

            return response()->json([
                'status' => true,
                'message' => "Data berhasil diambil",
                'data' => $penerimaBantuanSosial->latest()->get()
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

            $penerimaBantuanSosial = PenerimaanBantuanSosialModel::create([
                'status' => $request->status,
            ]);
            return response()->json([
                'status' => true,
                'message' => $penerimaBantuanSosial->status . " berhasil ditambahkan!",
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
        $penerimaBantuanSosialId = PenerimaanBantuanSosialModel::where("id", $id)->first();
        if (!$penerimaBantuanSosialId) {
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

        $penerimaBantuanSosialId->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => "Data berhasil di ubah!",
        ]);
    }

    public function destroy(string $id)
    {
        $penerimaBantuanSosialId = PenerimaanBantuanSosialModel::where("id", $id)->first();
        if (!$penerimaBantuanSosialId) {
            return response()->json([
                'status' => false,
                'message' => 'Tidak menemukan tahun id',
            ]);
        }
        $penerimaBantuanSosialId->delete();
        return response()->json([
            'status' => true,
            'message' => "Data berhasil dihapus!",
        ]);
    }
}
