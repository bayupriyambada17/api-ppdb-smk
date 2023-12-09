<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\PesertaDidikResource;
use App\Http\Resources\TahunPelajaran\DataPesertaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TahunPelajaranGetPesertaResource extends JsonResource
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
            'tahun_pelajaran' => $this->tahun_pelajaran,
            'peserta' => DataPesertaResource::collection($this->pesertaDidik),
            // 'peserta_didik' => $this->pesertaDidik->map(function ($pesertaDidik) {
            //     return [
            //         'nomor_pendaftar' => $pesertaDidik->nomor_pendaftar,
            //         'nisn' => $pesertaDidik->nisn,
            //         'nik' => $pesertaDidik->nik,
            //         'nama_lengkap' => $pesertaDidik->nama_lengkap,
            //         'provinsi' => $pesertaDidik->provinsi->name
            //     ];
            // }),
            // 'peserta_didk' => $this->load('pesertaDidik')
            // 'peserta_didik' => [
            //     'nomor_pendaftar' => $this->pesertaDidik->first()->nomor_pendaftar,
            //     'nama_lengkap' => $this->pesertaDidik->first()->nama_lengkap,
            // ]
            // 'nomor_pendaftar' => $this->pesertaDidik->nomor_pendaftar,
            // 'nama_lengkap' => $this->nama_lengkap,
            // 'provinsi' => $this->pesertaDidik->provinsi->name
        ];
    }
}
