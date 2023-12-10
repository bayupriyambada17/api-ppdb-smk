<?php

namespace App\Http\Controllers\API\Public;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\{
    ValidatorMessageHelper,
    NotificationStatus,
    ConstantaHelper,
    FileHelper,
    UploadHelper
};
use App\Models\{
    PesertaDidikUploadDokumenModel,
    PesertaDidikRaporModel,
    PesertaDidikModel,
    PesertaDidikFasilitatorModel,
    PesertaDidikFisilitasModel,
    PesertaDidikRiwayatModel
};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class PesertaDidikController extends Controller
{
    public function postPesertaDidik(Request $request)
    {
        // try {
        //     $validator = $this->validationPesertaDidik($request);

        //     if ($validator->fails()) {
        //         return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
        //     }

        //     $peserta = $this->createPesertaDidik($request);
        //     $peserta->save();

        //     $validator = $this->validatorPesertaDidikFasilitator($request);
        //     if ($validator->fails()) {
        //         $peserta->delete();
        //         return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
        //     }

        //     $fasilitatorData = $this->createPesertaDidikFasilitator($request, $peserta);
        //     $fasilitator = $fasilitatorData[0];
        //     $fasilitator->save();

        //     $validator = $this->validatorPesertaDidikRapor($request);
        //     if ($validator->fails()) {
        //         $peserta->delete();
        //         $fasilitator->delete();
        //         return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
        //     }

        //     $raporData = $this->createPesertaDidikRapor($request, $peserta);
        //     $rapor = $raporData[0];
        //     $rapor->save();

        //     $validator = $this->validatorPesertaDidikFasilitas($request);
        //     if ($validator->fails()) {
        //         $fasilitator->delete();
        //         $rapor->delete();
        //         $peserta->delete();
        //         return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
        //     }

        //     $fasilitasData = $this->createPesertaDidikFasilitas($request, $peserta);
        //     $fasilitas = $fasilitasData[0];
        //     $fasilitas->save();

        //     $validator = $this->validatorPesertaDidikRiwayat($request);
        //     if ($validator->fails()) {
        //         $fasilitator->delete();
        //         $rapor->delete();
        //         $fasilitas->delete();
        //         $peserta->delete();
        //         return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
        //     }

        //     $riwayatData = $this->createPesertaDidikRiwayat($request, $peserta);
        //     $riwayat = $riwayatData[0];
        //     $riwayat->save();

        //     $validator = $this->validatorPesertaDidikDokumen($request);
        //     if ($validator->fails()) {
        //         $fasilitator->delete();
        //         $rapor->delete();
        //         $fasilitas->delete();
        //         $riwayat->delete();
        //         $peserta->delete();
        //         return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
        //     }

        //     $dokumenData = $this->createPesertaDidikDokumen($request, $peserta);
        //     $dokumen = $dokumenData[0];
        //     $dokumen->save();
        //     if ($validator->fails()) {
        //         $fasilitator->delete();
        //         $rapor->delete();
        //         $fasilitas->delete();
        //         $riwayat->delete();
        //         $peserta->delete();
        //         $dokumen->delete();
        //         return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
        //     }

        //     return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, null, 200);
        // } catch (\Exception $e) {
        //     // Handle any exceptions here
        //     return NotificationStatus::notifError(false, ConstantaHelper::DataTidakTersimpan, $e->getMessage(), 500);
        // }

        try {
            // Validate all the data
            $pesertaValidator = $this->validationPesertaDidik($request);
            $fasilitatorValidator = $this->validatorPesertaDidikFasilitator($request);
            $raporValidator = $this->validatorPesertaDidikRapor($request);
            $fasilitasValidator = $this->validatorPesertaDidikFasilitas($request);
            $riwayatValidator = $this->validatorPesertaDidikRiwayat($request);
            $dokumenValidator = $this->validatorPesertaDidikDokumen($request);

            // Combine all validation errors
            $allErrors = new MessageBag();

            if ($pesertaValidator->fails()) {
                $allErrors->merge($pesertaValidator->errors());
            }
            if ($fasilitatorValidator->fails()) {
                $allErrors->merge($fasilitatorValidator->errors());
            }
            if ($raporValidator->fails()) {
                $allErrors->merge($raporValidator->errors());
            }
            if ($fasilitasValidator->fails()) {
                $allErrors->merge($fasilitasValidator->errors());
            }
            if ($riwayatValidator->fails()) {
                $allErrors->merge($riwayatValidator->errors());
            }
            if ($dokumenValidator->fails()) {
                $allErrors->merge($dokumenValidator->errors());
            }
            DB::beginTransaction();

            if ($allErrors->any()) {
                return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $allErrors);
            }

            try {
                $peserta = $this->createPesertaDidik($request);
                $peserta->save();

                $fasilitatorData = $this->createPesertaDidikFasilitator($request, $peserta);
                $fasilitator = $fasilitatorData[0];
                $fasilitator->save();

                $raporData = $this->createPesertaDidikRapor($request, $peserta);
                $rapor = $raporData[0];
                $rapor->save();

                $fasilitasData = $this->createPesertaDidikFasilitas($request, $peserta);
                $fasilitas = $fasilitasData[0];
                $fasilitas->save();

                $riwayatData = $this->createPesertaDidikRiwayat($request, $peserta);
                $riwayat = $riwayatData[0];
                $riwayat->save();

                $dokumenData = $this->createPesertaDidikDokumen($request, $peserta);
                $dokumen = $dokumenData[0];
                $dokumen->save();

                DB::commit();

                return NotificationStatus::notifSuccess(true, ConstantaHelper::DataTersimpan, null, 200);
            } catch (\Exception $e) {
                // Rollback the transaction in case of an exception
                DB::rollBack();

                return NotificationStatus::notifError(false, ConstantaHelper::DataTidakTersimpan, $e->getMessage(), 500);
            }
        } catch (\Exception $e) {
            // Handle any exceptions here
            return NotificationStatus::notifError(false, ConstantaHelper::DataTidakTersimpan, $e->getMessage(), 500);
        }
    }

    protected function validatorFails($validator, $peserta)
    {
        if ($validator->fails()) {
            $peserta->delete();
            return NotificationStatus::notifValidator(false, ConstantaHelper::ValidationError, $validator->errors());
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
        $peserta->bahasa_asing = $request->bahasa_asing;
        $peserta->jumlah_hafalan_juz = $request->jumlah_hafalan_juz;
        $peserta->hafalan_juz = $request->hafalan_juz;
        $peserta->riwayat_prestasi_calon_peserta_didik = $request->riwayat_prestasi_calon_peserta_didik;
        $peserta->riwayat_organisasi_sekolah_dan_non_sekolah = $request->riwayat_organisasi_sekolah_dan_non_sekolah;
        $peserta->hal_hal_khusus = $request->hal_hal_khusus;
        $peserta->cita_cita = $request->cita_cita;
        $peserta->hobi_kegemaran = $request->hobi_kegemaran;
        $peserta->nama_ayah_kandung = $request->nama_ayah_kandung;
        $peserta->pendidikan_terakhir_ayah_id = $request->pendidikan_terakhir_ayah_id;
        $peserta->pekerjaan_ayah_kandung = $request->pekerjaan_ayah_kandung;
        $peserta->penghasilan_pokok_pensiunan_ayah = $request->penghasilan_pokok_pensiunan_ayah;
        $peserta->pendapatan_diluar_penghasilan_perbulan_ayah = $request->pendapatan_diluar_penghasilan_perbulan_ayah;
        $peserta->domisili_ayah_kandung = $request->domisili_ayah_kandung;
        $peserta->no_whatsapp_ayah_kandung = $request->no_whatsapp_ayah_kandung;
        $peserta->nama_ibu_kandung = $request->nama_ibu_kandung;
        $peserta->pekerjaan_ibu_kandung = $request->pekerjaan_ibu_kandung;
        $peserta->penghasilan_pokok_pensiunan_ibu = $request->penghasilan_pokok_pensiunan_ibu;
        $peserta->pendapatan_diluar_penghasilan_perbulan_ibu = $request->pendapatan_diluar_penghasilan_perbulan_ibu;
        $peserta->domisili_ibu_kandung = $request->domisili_ibu_kandung;
        $peserta->no_whatsapp_ibu_kandung = $request->no_whatsapp_ibu_kandung;
        $peserta->pendidikan_terakhir_ibu_id = $request->pendidikan_terakhir_ibu_id;
        $peserta->harapan_orang_tua = $request->harapan_orang_tua;
        $peserta->nama_wali = $request->nama_wali;
        $peserta->pekerjaan_wali = $request->pekerjaan_wali;
        $peserta->alamat_domisili_wali = $request->alamat_domisili_wali;
        $peserta->hubungan_wali = $request->hubungan_wali;
        $peserta->email_wali = $request->email_wali;
        $peserta->penghasilan_wali = $request->penghasilan_wali;
        $peserta->jumlah_tanggungan_dalam_keluarga = $request->jumlah_tanggungan_dalam_keluarga;
        $peserta->sumber_penghasilan_id = $request->sumber_penghasilan_id;

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
            'sosial_media' => 'nullable',
                'smp_derajat' => 'required',
                'npsn' => 'required',
                'tahun_lulus_id' => 'required',
                'anak_ke_sodara' => 'required',
                'keadaan_orang_tua_id' => 'required',
                'status_dalam_keluarga_id' => 'required',
                'tinggal_bersama_status_id' => 'required',
                'penerimaan_bantuan_sosial_id' => 'required',
            'bahasa_asing' => 'nullable',
            'jumlah_hafalan_juz' => 'required',
            'hafalan_juz' => 'required',
            'riwayat_prestasi_calon_peserta_didik' => 'nullable',
            'riwayat_organisasi_sekolah_dan_non_sekolah' => 'nullable',
            'hal_hal_khusus' => 'required',
            'cita_cita' => 'required',
            'hobi_kegemaran' => 'required',
            'nama_ayah_kandung' => 'required',
            'pendidikan_terakhir_ayah_id' => 'required',
            'pekerjaan_ayah_kandung' => 'required',
            'penghasilan_pokok_pensiunan_ayah' => 'required',
            'pendapatan_diluar_penghasilan_perbulan_ayah' => 'required',
            'domisili_ayah_kandung' => 'required',
            'no_whatsapp_ayah_kandung' => 'required|min:10|max:15',
            'nama_ibu_kandung' => 'required',
            'pekerjaan_ibu_kandung' => 'required',
            'penghasilan_pokok_pensiunan_ibu' => 'required',
            'pendapatan_diluar_penghasilan_perbulan_ibu' => 'required',
            'domisili_ibu_kandung' => 'required',
            'no_whatsapp_ibu_kandung' => 'required|min:10|max:15',
            'pendidikan_terakhir_ibu_id' => 'required',
            'harapan_orang_tua' => 'required',
            'nama_wali' => 'nullable',
            'pekerjaan_wali' => 'nullable',
            'alamat_domisili_wali' => 'nullable',
            'hubungan_wali' => 'nullable',
            'email_wali' => 'nullable|email',
            'penghasilan_wali' => 'nullable',
            'jumlah_tanggungan_dalam_keluarga' => 'required',
            'sumber_penghasilan_id' => 'required',
            ], ValidatorMessageHelper::validator());
    }

    protected function validatorPesertaDidikRapor(Request $request)
    {
        return Validator::make($request->all(), [
            'rapor_matematika_3' => 'required',
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

    protected function validatorPesertaDidikFasilitator(Request $request)
    {
        return Validator::make($request->all(), [
            'nama_fasilitator' => 'required',
            'hubungan_calon_siswa_fasilitator' => 'required',
            'no_whatsapp_fasilitator' => 'required',
            'email_fasilitator' => 'nullable|email',
            'informasi_ppdb_id' => 'required',
            'saudara_beasiswa_di_smk_fasilitator' => 'required|boolean',
        ], ValidatorMessageHelper::validator());
    }
    protected function createPesertaDidikFasilitator(Request $request, $peserta)
    {
        $fasilitator = new PesertaDidikFasilitatorModel();
        $fasilitator->peserta_didik_id = $peserta->id;
        $fasilitator->nama_fasilitator = $request->nama_fasilitator;
        $fasilitator->hubungan_calon_siswa_fasilitator = $request->hubungan_calon_siswa_fasilitator;
        $fasilitator->no_whatsapp_fasilitator = $request->no_whatsapp_fasilitator;
        $fasilitator->email_fasilitator = $request->email_fasilitator;
        $fasilitator->saudara_beasiswa_di_smk_fasilitator = $request->saudara_beasiswa_di_smk_fasilitator; // boolean
        return  [$fasilitator, $peserta];
    }

    protected function validatorPesertaDidikRiwayat(Request $request)
    {
        return Validator::make($request->all(), [
            'tinggi_badan' => 'required',
            'berat_badan' => 'required',
            'penyakit_di_derita' => 'required',
            'penyakit_menular' => 'required',
            'golongan_darah_id' => 'required',
            'perokok' => 'required|boolean',
            'buta_warna' => 'required|boolean',
            'asuransi_bpjs_kis' => 'required|boolean',
        ], ValidatorMessageHelper::validator());
    }
    protected function createPesertaDidikRiwayat(Request $request, $peserta)
    {
        $fasilitator = new PesertaDidikRiwayatModel();
        $fasilitator->peserta_didik_id = $peserta->id;
        $fasilitator->tinggi_badan = $request->tinggi_badan;
        $fasilitator->berat_badan = $request->berat_badan;
        $fasilitator->penyakit_di_derita = $request->penyakit_di_derita;
        $fasilitator->penyakit_menular = $request->penyakit_menular;
        $fasilitator->golongan_darah_id = $request->golongan_darah_id;
        $fasilitator->perokok = $request->perokok;
        $fasilitator->buta_warna = $request->buta_warna;
        $fasilitator->asuransi_bpjs_kis = $request->asuransi_bpjs_kis;
        return  [$fasilitator, $peserta];
    }

    protected function validatorPesertaDidikDokumen(Request $request)
    {
        $rules = [
            'kartu_keluarga' => 'required|mimes:pdf,docx,doc,png,jpeg,jpg|max:2048',
            'pas_foto' => 'required|mimes:pdf,docx,doc,png,jpeg,jpg|max:2048',
            'sktm' => 'required|mimes:pdf,docx,doc,png,jpeg,jpg|max:2048',
            'upload_surat_rekomendasi' => 'required|mimes:pdf,docx,doc,png,jpeg,jpg|max:2048',
            'upload_pdf_foto_rumah' => 'required|mimes:pdf,docx,doc,png,jpeg,jpg|max:2048',
            'essay_karangan' => 'required|mimes:pdf,docx,doc,png,jpeg,jpg|max:2048',
            'rangkaian_tes' => 'required|boolean',
            'dokumen_jika_palsu' => 'required|boolean',
            'pelanggaran_keputusan' => 'required|boolean',
        ];

        // Apply mimes validation for scan_bpjs_kis only if it is present
        if ($request->hasFile('scan_bpjs_kis')) {
            $rules['scan_bpjs_kis'] = 'mimes:pdf,docx,doc,png,jpeg,jpg|max:2048';
        }

        return Validator::make($request->all(), $rules, ValidatorMessageHelper::validator());
    }

    protected function createPesertaDidikDokumen(Request $request, $peserta)
    {
        $dokumen = new PesertaDidikUploadDokumenModel();
        $dokumen->peserta_didik_id = $peserta->id;

        $scan_bpjs_kis = $request->file('scan_bpjs_kis');
        if ($scan_bpjs_kis) {
            $bpjsKisFile = str_replace(" ", "", $peserta->nama_lengkap) . '-' . $scan_bpjs_kis->hashName();
            $scan_bpjs_kis->storeAs('files/scan_bpjs_kis', $bpjsKisFile, 'public');
        } else {
            $bpjsKisFile = null;
        }
        $kartu_keluarga = $request->file('kartu_keluarga');
        $kkFile = str_replace(" ", "", $peserta->nama_lengkap) . '-' . $kartu_keluarga->hashName();
        $kartu_keluarga->storeAs('files/kartu_keluarga', $kkFile, 'public');

        $pas_foto = $request->file('pas_foto');
        $pasFotoFile = str_replace(" ", "", $peserta->nama_lengkap) . '-' . $pas_foto->hashName();
        $pas_foto->storeAs('files/pas_foto', $pasFotoFile, 'public');

        $sktm = $request->file('sktm');
        $sktmFile = str_replace(" ", "", $peserta->nama_lengkap) . '-' . $sktm->hashName();
        $sktm->storeAs('files/sktm', $sktmFile, 'public');

        $upload_surat_rekomendasi = $request->file('upload_surat_rekomendasi');
        $uploadSuratRekomendasiFile = str_replace(" ", "", $peserta->nama_lengkap) . '-' . $upload_surat_rekomendasi->hashName();
        $upload_surat_rekomendasi->storeAs('files/upload_surat_rekomendasi', $uploadSuratRekomendasiFile, 'public');

        $upload_pdf_foto_rumah = $request->file('upload_pdf_foto_rumah');
        $uploadPdfFotoRumah = str_replace(" ", "", $peserta->nama_lengkap) . '-' . $upload_pdf_foto_rumah->hashName();
        $upload_pdf_foto_rumah->storeAs('files/upload_pdf_foto_rumah', $uploadPdfFotoRumah, 'public');

        $essay_karangan = $request->file('essay_karangan');
        $essayKaranganFile = str_replace(" ", "", $peserta->nama_lengkap) . '-' . $essay_karangan->hashName();
        $essay_karangan->storeAs('files/essay_karangan', $essayKaranganFile, 'public');

        $dokumen->kartu_keluarga = $kkFile;
        $dokumen->pas_foto = $pasFotoFile;
        $dokumen->sktm = $sktmFile;
        $dokumen->scan_bpjs_kis = $bpjsKisFile ?? null;
        $dokumen->upload_surat_rekomendasi = $uploadSuratRekomendasiFile;
        $dokumen->upload_pdf_foto_rumah = $uploadPdfFotoRumah;
        $dokumen->essay_karangan = $essayKaranganFile;
        $dokumen->rangkaian_tes = $request->rangkaian_tes;
        $dokumen->dokumen_jika_palsu = $request->dokumen_jika_palsu;
        $dokumen->pelanggaran_keputusan = $request->pelanggaran_keputusan;
        return [$dokumen, $peserta];
    }

    protected function validatorPesertaDidikFasilitas(Request $request)
    {
        return Validator::make($request->all(), [
            'status_kepemilikan_rumah_id' => 'required',
            'tahun_perolehan_status_kepemilikan' => 'required',
            'kualitas_rumah_id' => 'required',
            'luas_tanah_id' => 'required',
            'mandi_cuci_kakus_id' => 'required',
            'sumber_air_id' => 'required',
            'daya_listrik_id' => 'required',
            'harta_tidak_bergerak_id' => 'required',
            'status_kepemelikan_htb_id' => 'required',
            'kepemilikan_kendaraan_id' => 'required',
            'status_kepemilikan_kendaraan_id' => 'required',
        ], ValidatorMessageHelper::validator());
    }

    protected function createPesertaDidikFasilitas(Request $request, $peserta)
    {
        $fasilitas = new PesertaDidikFisilitasModel();
        $fasilitas->peserta_didik_id = $peserta->id;
        $fasilitas->status_kepemilikan_rumah_id = $request->status_kepemilikan_rumah_id;
        $fasilitas->kualitas_rumah_id = $request->kualitas_rumah_id;
        $fasilitas->luas_tanah_id = $request->luas_tanah_id;
        $fasilitas->mandi_cuci_kakus_id = $request->mandi_cuci_kakus_id;
        $fasilitas->sumber_air_id = $request->sumber_air_id;
        $fasilitas->daya_listrik_id = $request->daya_listrik_id;
        $fasilitas->harta_tidak_bergerak_id = $request->harta_tidak_bergerak_id;
        $fasilitas->status_kepemelikan_htb_id = $request->status_kepemelikan_htb_id;
        $fasilitas->kepemilikan_kendaraan_id = $request->kepemilikan_kendaraan_id;
        $fasilitas->status_kepemilikan_kendaraan_id = $request->status_kepemilikan_kendaraan_id;
        return [$fasilitas, $peserta];
    }
}
