<?php

namespace App\Http\Controllers\API\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Models\PesertaDidikFisilitasModel;
use App\Models\PesertaDidikModel;
use Illuminate\Support\Facades\Validator;

class PesertaDidikController extends Controller
{
    public function postPesertaDidik(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tahun_pelajaran_id' => 'required',
                'nama_lengkap' => 'required',
                'nisn' => 'required|unique:peserta_didik,nisn',
                'nik' => 'required|unique:peserta_didik,nik',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'provinsi' => 'required',
                'kota_kabupaten' => 'required',
                'no_whatsapp_telp' => 'required',
                'sosial_media' => 'required',
                'smp_derajat' => 'required',
                'npsn' => 'required',
                'tahun_lulus_id' => 'required',
                'anak_ke_sodara' => 'required',
                'keadaan_orang_tua_id' => 'required',
                'status_dalam_keluarga_id' => 'required',
                'tinggal_bersama_status_id' => 'required',
                'penerimaan_bantuan_sosial_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => ConstantaHelper::ValidationError,
                    'errors' => $validator->errors()
                ], 401);
            }

            $peserta = PesertaDidikModel::create([
                'tahun_pelajaran_id' => $request->tahun_pelajaran_id,
                'nama_lengkap' => $request->nama_lengkap,
                'nisn' => $request->nisn,
                'nik' => $request->nik,
                'tanggal_terdaftar' => now(),
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota_kabupaten' => $request->kota_kabupaten,
                'no_whatsapp_telp' => $request->no_whatsapp_telp,
                'sosial_media' => $request->sosial_media,
                'smp_derajat' => $request->smp_derajat,
                'npsn' => $request->npsn,
                'tahun_lulus_id' => $request->tahun_lulus_id,
                'anak_ke_sodara' => $request->anak_ke_sodara,
                'keadaan_orang_tua_id' => $request->keadaan_orang_tua_id,
                'status_dalam_keluarga_id' => $request->status_dalam_keluarga_id,
                'tinggal_bersama_status_id' => $request->tinggal_bersama_status_id,
                'penerimaan_bantuan_sosial_id' => $request->penerimaan_bantuan_sosial_id,
            ]);
            if ($peserta) {
                $validator = Validator::make($request->all(), [
                    'nama_fasilitator' => 'required',
                    // Add other validation rules
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => ConstantaHelper::ValidationError,
                        'errors' => $validator->errors()
                    ], 401);
                }

                try {
                    $fasilitator = $peserta->fasilitator()->create([
                        'peserta_didik_id' => $peserta->id,
                        'nama_fasilitator' => $request->nama_fasilitator,
                        // Add other fields
                    ]);

                    $rapor = $peserta->rapor()->create([
                        'peserta_didik_id' => $peserta->id,
                        'rapor_matematika_3' => $request->rapor_matematika_3,
                        'rapor_matematika_4' => $request->rapor_matematika_4,
                        'rapor_matematika_5' => $request->rapor_matematika_5,

                    ]);

                    if ($fasilitator && $rapor) {
                        return response()->json([
                            'status' => true,
                            'message' => ConstantaHelper::DataTersimpan,
                            'peserta' => $peserta,
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => ConstantaHelper::DataTidakTersimpan,
                        ], 400);
                    }
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => false,
                        'message' => ConstantaHelper::DataTidakTersimpan,
                        'error' => $e->getMessage(),
                    ], 500);
                }
            }
        } catch (\Exception $e) {
            return NotificationStatus::notifError(false, $e->getMessage(), null, 500);
        }
    }
}
