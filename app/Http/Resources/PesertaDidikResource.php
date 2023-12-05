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
            'nomor_pendaftaran' => $this->nomor_pendaftar,
            'nama_lengkap' => $this->nama_lengkap,
            'nisn' => $this->nisn,
            'nik' => $this->nik,
            'tahun_pelajaran' => $this->tahunPelajaran->tahun_pelajaran,
            'tempat_tanggal_lahir' => $this->tempat_lahir . ", " . $this->tanggal_lahir,
            'kabupaten_provinsi' => $this->kota_kabupaten . ", " . $this->provinsi->name,
            'no_wa' => $this->no_whatsapp_telp,
            'harapan' => $this->harapan_orang_tua ?? "(Belum mempunyai harapan orang tua)",
            'ayah' => [
                'nama' => $this->nama_ayah_kandung,
                'pendidikan_terakhir' => $this->pendidikanAyah->status,
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
            ]
        ];
    }
}
