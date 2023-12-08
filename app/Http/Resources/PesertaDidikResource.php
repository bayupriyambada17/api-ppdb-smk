<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PesertaDidikResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nomor_pendaftaran' => $this->nomor_pendaftar ?? "(-)",
            'nama_lengkap' => $this->nama_lengkap ?? "(-)",
            'nisn' => $this->nisn ?? "(-)",
            'nik' => $this->nik ?? "(-)",
            'tahun_pelajaran' => $this->tahunPelajaran->tahun_pelajaran ?? "(-)",
            'tempat_tanggal_lahir' => $this->tempat_lahir . ", " . $this->tanggal_lahir ?? "(-)",
            'kabupaten_provinsi' => $this->kota_kabupaten . ", " . $this->provinsi->name ?? "(-)",
            'no_wa' => $this->no_whatsapp_telp ?? "(-)",
            'harapan' => $this->harapan_orang_tua ?? "(Belum mempunyai harapan orang tua)",
            'informasi_ppdb' => $this->fasilitator->informasiPpdb->status ?? "(-)",
            'sosial_media' => $this->sosial_media ?? "(-)",
            'smp_derajat' => $this->smp_derajat ?? "(-)",
            'npsn' => $this->npsn ?? "(-)",
            'tahun_lulus' => $this->tahunLulus->tahun ?? "(-)",
            'anak_ke_sodara' => $this->anak_ke_sodara ?? "(-)",
            'keadaan_orang_tua' => $this->keadaanOrangTua->status ?? "(-)",
            'status_dalam_keluarga' => $this->statusDalamKeluarga->status ?? "(-)",
            'ayah' => [
                'nama' => $this->nama_ayah_kandung ?? "(-)",
                'pendidikan_terakhir' => $this->pendidikanAyah->status ?? "(-)",
                'pekerjaan' => $this->pekerjaan_ayah_kandung ?? "(-)",
                'penghasilan_pokok_pensiun' => $this->penghasilan_pokok_pensiunan_ayah ?? "(-)",
                'pendapatan_diluar_penghasilan' => $this->pendapatan_diluar_penghasilan_perbulan_ayah ?? "(-)",
                'domisili' => $this->domisili_ayah_kandung ?? "(-)",
                'no_wa' => $this->no_whatsapp_ayah_kandung ?? "(-)",
            ],
            'ibu' => [
                'nama' => $this->nama_ibu_kandung ?? "(-)",
                'pendidikan_terakhir' => $this->pendidikanIbu->status ?? "(-)",
                'pekerjaan' => $this->pekerjaan_ibu_kandung ?? "(-)",
                'penghasilan_pokok_pensiun' => $this->penghasilan_pokok_pensiunan_ibu ?? "(-)",
                'pendapatan_diluar_penghasilan' => $this->pendapatan_diluar_penghasilan_perbulan_ibu ?? "(-)",
                'domisili' => $this->domisili_ibu_kandung ?? "(-)",
                'no_wa' => $this->no_whatsapp_ibu_kandung ?? "(-)",
            ],
            'wali' => [
                'nama' => $this->nama_wali ?? "(-)",
                'pekerjaan' => $this->pekerjaan_wali ?? "(-)",
                'email_wali' => $this->email_wali ?? "(-)",
                'domisili' => $this->alamat_domisili_wali ?? "(-)",
                'hubungan_wali' => $this->hubungan_wali ?? "(-)",
            ],
            'rapor' => [
                'matematika_3' => (int) $this->rapor->rapor_matematika_3 ?? 0,
                'matematika_4' => (int) $this->rapor->rapor_matematika_4 ?? 0,
                'matematika_5' => (int) $this->rapor->rapor_matematika_5 ?? 0,
                'ipa_3' => (int) $this->rapor->rapor_ipa_3 ?? 0,
                'ipa_4' => (int) $this->rapor->rapor_ipa_4 ?? 0,
                'ipa_5' => (int) $this->rapor->rapor_ipa_5 ?? 0,
                'indo_3' => (int) $this->rapor->rapor_indo_3 ?? 0,
                'indo_4' => (int) $this->rapor->rapor_indo_4 ?? 0,
                'indo_5' => (int) $this->rapor->rapor_indo_5 ?? 0,
                'inggris_3' => (int) $this->rapor->rapor_inggris_3 ?? 0,
                'inggris_4' => (int) $this->rapor->rapor_inggris_4 ?? 0,
                'inggris_5' => (int) $this->rapor->rapor_inggris_5 ?? 0,
                'islam_3' => (int) $this->rapor->rapor_islam_3 ?? 0,
                'islam_4' => (int) $this->rapor->rapor_islam_4 ?? 0,
                'islam_5' => (int) $this->rapor->rapor_islam_5 ?? 0,
            ],
            "fasilitas" => [
                'status_kepemilikan_rumah' => $this->fasilitas->statusKepemilikanRumah->status ?? "(-)",
                'tahun_perolehan' => $this->fasilitas->tahun_perolehan_status_kepemilikan ?? "(-)",
                'kualitas_rumah' => $this->fasilitas->kualitasRumah->status ?? "(-)",
                'luas_tanah' => $this->fasilitas->luasTanah->status ?? "(-)",
                'mandi_cuci_kakus' => $this->fasilitas->mandiCuciKakus->status ?? "(-)",
                'sumber_air' => $this->fasilitas->sumberAir->status ?? "(-)",
                'daya_listrik' => $this->fasilitas->dayaListrik->status ?? "(-)",
                'harta_tak_bergerak' => $this->fasilitas->hartaTidakBergerak->status ?? "(-)",
                'status_kepemilikan_htb' => $this->fasilitas->statusKepemilikanHtb->status ?? "(-)",
            ],
            "fasilitator" => [
                'nama' => $this->fasilitator->nama_fasilitator ?? "(-)",
                'hubungan_calon_siswa' => $this->fasilitator->hubungan_calon_siswa_fasilitator ?? "(-)",
                'no_wa' => $this->fasilitator->no_whatsapp_fasilitator ?? "(-)",
                'email' => $this->fasilitator->email_fasilitator ?? "(-)",
                'saudara_di_smk' => $this->fasilitator->saudara_beasiswa_di_smk_fasilitator
            ],
            "riwayat" => [
                'tinggi_badan' => (int) $this->riwayatPenyakit->tinggi_badan ?? 0,
                'berat_badan' => (int) $this->riwayatPenyakit->berat_badan ?? 0,
                'penyakit_di_derita' => $this->riwayatPenyakit->penyakit_di_derita ?? "(-)",
                'penyakit_menular' => $this->riwayatPenyakit->penyakit_menular ?? "(-)",
                'golongan_darah' => str_replace(" ", "", $this->riwayatPenyakit->golonganDarah->status) ?? "(-)",
                'perokok' => $this->riwayatPenyakit->perokok,
                'buta_warna' => $this->riwayatPenyakit->buta_warna,
                'asuransi_bpjs_kis' => $this->riwayatPenyakit->asuransi_bpjs_kis,
            ],
            "dokumen" => [
                "kk" => $this->uploadDokumen->kartu_keluarga ?? "#",
                "pas_foto" => $this->uploadDokumen->pas_foto ?? "#",
                "sktm" => $this->uploadDokumen->sktm ?? "#",
                "upload_surat_rekomendasi" => $this->uploadDokumen->upload_surat_rekomendasi ?? "#",
                "upload_pdf_foto_rumah" => $this->uploadDokumen->upload_pdf_foto_rumah ?? "#",
                "essay_karangan" => $this->uploadDokumen->essay_karangan ?? "#",
                "rangkaian_tes" => $this->uploadDokumen->rangkaian_tes ?? "(-)",
                "dokumen_jika_palsu" => $this->uploadDokumen->dokumen_jika_palsu ?? "(-)",
                "pelanggaran_keputusan" => $this->uploadDokumen->pelanggaran_keputusan ?? "(-)",
            ]
        ];
    }
}
