<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Helpers\ConstantaHelper;
use App\Models\BannerPendaftaranModel;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\ValidatorMessageHelper;

class BannerPendaftaranController extends Controller
{
    public function all()
    {
        try {
            $banner = BannerPendaftaranModel::paginate(4);
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
            $replace = str_replace(" ", "", $gambar_ppdb->hashName());
            $gambar_ppdb->storeAs('files/gambar_ppdb', $replace, 'public');
            $data->gambar = $replace;
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

        $image_path = public_path('files/gambar_ppdb/' . basename($dataId->gambar));
        if (File::exists($image_path)) {
            unlink($image_path);
        }

        $dataId->delete();
        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTerhapus, null, 200);
    }
}
