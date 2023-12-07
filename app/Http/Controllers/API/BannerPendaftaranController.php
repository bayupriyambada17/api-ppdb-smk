<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Models\BannerPendaftaranModel;
use Illuminate\Support\Facades\Storage;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\ValidatorMessageHelper;

class BannerPendaftaranController extends Controller
{
    public function all()
    {
        try {
            $banner = BannerPendaftaranModel::get();
            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataDiambil, $banner, 200);
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
                'gambar' => 'required',
            ], ValidatorMessageHelper::validator());
            if ($validator->fails()) {
                return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
            }

            $data = new BannerPendaftaranModel();
            $gambar_ppdb = $request->file('gambar');
            $nama_file = str_replace(" ", "-", $gambar_ppdb->hashName());
            $gambar_ppdb->storeAs('public/gambar_ppdb', $nama_file);
            $data->gambar = $nama_file;
            $data->save();

            return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, null, 200);
        } catch (\Exception $e) {
            return NotificationStatus::notifError(
                false,
                $e->getMessage(),
                null,
                500
            );
        }
    }


    public function destroy(string $id)
    {
        $dataId = BannerPendaftaranModel::where("id", $id)->first();
        if (!$dataId) {
            return NotificationStatus::notifError(false, ConstantaHelper::IdTidakDitemukan, null, 404);
        }
        Storage::disk('local')->delete('public/gambar_ppdb/' . basename($dataId->gambar));
        $dataId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTerhapus, null, 200);
    }
}
