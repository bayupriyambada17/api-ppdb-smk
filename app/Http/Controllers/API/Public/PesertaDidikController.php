<?php

namespace App\Http\Controllers\API\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Http\Helpers\NotificationStatus;
use App\Http\Helpers\ValidatorMessageHelper;
use App\Models\PesertaDidikFasilitatorModel;
use App\Models\PesertaDidikModel;
use App\Models\PesertaDidikRaporModel;
use Illuminate\Support\Facades\Validator;
class PesertaDidikController extends Controller
{
    public function postPesertaDidik(Request $request)
    {
        try {

            $validator = $this->validationPesertaDidik($request);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => ConstantaHelper::ValidationError,
                    'errors' => $validator->errors()
                ], 401);
            }

            $peserta = $this->createPesertaDidik($request);
            try {
                $peserta->save();

                $validator = $this->validatorPesertaDidikFasilitator($request);
                if ($validator->fails()) {
                    $peserta->delete(); // Rollback the peserta creation
                    return response()->json([
                        'status' => false,
                        'message' => ConstantaHelper::ValidationError,
                        'errors' => $validator->errors()
                    ], 401);
                }

                $fasilitator = new PesertaDidikFasilitatorModel();
                $fasilitator->peserta_didik_id = $peserta->id;
                $fasilitator->nama_fasilitator = $request->nama_fasilitator;
                $fasilitator->hubungan_calon_siswa_fasilitator = $request->hubungan_calon_siswa_fasilitator;
                $fasilitator->no_whatsapp_fasilitator = $request->no_whatsapp_fasilitator;
                $fasilitator->email_fasilitator = $request->email_fasilitator;
                $fasilitator->saudara_beasiswa_di_smk_fasilitator = $request->saudara_beasiswa_di_smk_fasilitator; // boolean

                try {
                    $fasilitator->save();
                    $validator = $this->validatorPesertaDidikRapor($request);

                    if ($validator->fails()) {
                        $peserta->delete(); // Rollback the peserta creation
                        return response()->json([
                            'status' => false,
                            'message' => ConstantaHelper::ValidationError,
                            'errors' => $validator->errors()
                        ], 401);
                    }
                    $raporData = $this->createPesertaDidikRapor($request, $peserta);
                    $rapor = $raporData[0];
                    // $rapor = new PesertaDidikRaporModel();
                    // $rapor->peserta_didik_id = $peserta->id;
                    // $rapor->rapor_matematika_3 = $request->rapor_matematika_3;
                    // $rapor->rapor_matematika_4 = $request->rapor_matematika_4;
                    // $rapor->rapor_matematika_5 = $request->rapor_matematika_5;
                    // $rapor->rapor_ipa_3 = $request->rapor_ipa_3;
                    // $rapor->rapor_ipa_4 = $request->rapor_ipa_4;
                    // $rapor->rapor_ipa_5 = $request->rapor_ipa_5;
                    // $rapor->rapor_indo_3 = $request->rapor_indo_3;
                    // $rapor->rapor_indo_4 = $request->rapor_indo_4;
                    // $rapor->rapor_indo_5 = $request->rapor_indo_5;
                    // $rapor->rapor_inggris_3 = $request->rapor_inggris_3;
                    // $rapor->rapor_inggris_4 = $request->rapor_inggris_4;
                    // $rapor->rapor_inggris_5 = $request->rapor_inggris_5;
                    // $rapor->rapor_islam_3 = $request->rapor_islam_3;
                    // $rapor->rapor_islam_4 = $request->rapor_islam_4;
                    // $rapor->rapor_islam_5 = $request->rapor_islam_5;

                    try {
                        $rapor->save();
                        return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, null, 200);
                    } catch (\Exception $e) {
                        // Handle exception for saving rapor
                        $peserta->delete(); // Rollback the peserta and fasilitator creation
                        $fasilitator->delete();
                        return NotificationStatus::notifError(false, ConstantaHelper::DataTidakTersimpan, $e->getMessage(), 500);
                    }
                } catch (\Exception $e) {
                    // Handle exception for saving fasilitator
                    $peserta->delete(); // Rollback the peserta creation
                    return NotificationStatus::notifError(false, ConstantaHelper::DataTidakTersimpan, $e->getMessage(), 500);
                }
            } catch (\Exception $e) {
                // Handle exception for saving peserta
                return NotificationStatus::notifError(false, ConstantaHelper::DataTidakTersimpan, $e->getMessage(), 500);
            }
        } catch (\Exception $e) {
            return NotificationStatus::notifError(false, $e->getMessage(), null, 500);
        }
    }

    protected function validatorFails($validator, $peserta)
    {
        if ($validator->fails()) {
            $peserta->delete(); // Rollback the peserta creation
            return response()->json([
                'status' => false,
                'message' => ConstantaHelper::ValidationError,
                'errors' => $validator->errors()
            ], 401);
        }
    }

    protected function createPesertaDidik(Request $request)
    {
        $peserta = new PesertaDidikModel();
        $peserta->tahun_pelajaran_id = $request->tahun_pelajaran_id;
        $peserta->nama_lengkap = $request->nama_lengkap;
        $peserta->nisn = $request->nisn;
        $peserta->nik = $request->nik;
        $peserta->tanggal_terdaftar = now();
        $peserta->tempat_lahir = $request->tempat_lahir;
        $peserta->tanggal_lahir = $request->tanggal_lahir;
        $peserta->alamat = $request->alamat;
        $peserta->provinsi_id = $request->provinsi_id;
        $peserta->kota_kabupaten = $request->kota_kabupaten;
        $peserta->no_whatsapp_telp = $request->no_whatsapp_telp;
        $peserta->sosial_media = $request->sosial_media;
        $peserta->smp_derajat = $request->smp_derajat;
        $peserta->npsn = $request->npsn;
        $peserta->tahun_lulus_id = $request->tahun_lulus_id;
        $peserta->anak_ke_sodara = $request->anak_ke_sodara;
        $peserta->keadaan_orang_tua_id = $request->keadaan_orang_tua_id;
        $peserta->status_dalam_keluarga_id = $request->status_dalam_keluarga_id;
        $peserta->tinggal_bersama_status_id = $request->tinggal_bersama_status_id;
        $peserta->penerimaan_bantuan_sosial_id = $request->penerimaan_bantuan_sosial_id;

        return $peserta;
    }

    protected function validationPesertaDidik(Request $request)
    {
        return
            Validator::make($request->all(), [
                'tahun_pelajaran_id' => 'required',
                'nama_lengkap' => 'required',
                'nisn' => 'required|unique:peserta_didik,nisn|min:10|max:10',
                'nik' => 'required|unique:peserta_didik,nik|max:16|min:16',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'provinsi_id' => 'required',
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
            ], ValidatorMessageHelper::validator());
    }

    protected function validatorPesertaDidikFasilitator(Request $request)
    {
        return Validator::make($request->all(), [
            'nama_fasilitator' => 'required',
            'rapor_matematika_4' => 'required',
            'rapor_matematika_5' => 'required',
            'rapor_ipa_3' => 'required',
            'rapor_ipa_4' => 'required',
            'rapor_ipa_5' => 'required',
            'rapor_indo_3' => 'required',
            'rapor_indo_4' => 'required',
            'rapor_indo_5' => 'required',
            'rapor_inggris_3' => 'required',
            'rapor_inggris_4' => 'required',
            'rapor_inggris_5' => 'required',
            'rapor_islam_3' => 'required',
            'rapor_islam_4' => 'required',
            'rapor_islam_5' => 'required',
        ], ValidatorMessageHelper::validator());
    }
    protected function validatorPesertaDidikRapor(Request $request)
    {
        return Validator::make($request->all(), [
            'rapor_matematika_3' => 'required',
            'hubungan_calon_siswa_fasilitator' => 'required',
            'no_whatsapp_fasilitator' => 'required',
            'email_fasilitator' => 'required|email',
            'saudara_beasiswa_di_smk_fasilitator' => 'required|boolean',
        ], ValidatorMessageHelper::validator());
    }

    protected function createPesertaDidikRapor(Request $request, $peserta)
    {
        $rapor = new PesertaDidikRaporModel();
        $rapor->peserta_didik_id = $peserta->id;
        $rapor->rapor_matematika_3 = $request->rapor_matematika_3;
        $rapor->rapor_matematika_4 = $request->rapor_matematika_4;
        $rapor->rapor_matematika_5 = $request->rapor_matematika_5;
        $rapor->rapor_ipa_3 = $request->rapor_ipa_3;
        $rapor->rapor_ipa_4 = $request->rapor_ipa_4;
        $rapor->rapor_ipa_5 = $request->rapor_ipa_5;
        $rapor->rapor_indo_3 = $request->rapor_indo_3;
        $rapor->rapor_indo_4 = $request->rapor_indo_4;
        $rapor->rapor_indo_5 = $request->rapor_indo_5;
        $rapor->rapor_inggris_3 = $request->rapor_inggris_3;
        $rapor->rapor_inggris_4 = $request->rapor_inggris_4;
        $rapor->rapor_inggris_5 = $request->rapor_inggris_5;
        $rapor->rapor_islam_3 = $request->rapor_islam_3;
        $rapor->rapor_islam_4 = $request->rapor_islam_4;
        $rapor->rapor_islam_5 = $request->rapor_islam_5;

        return [$rapor, $peserta];
    }

}
