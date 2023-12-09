<?php

namespace App\Http\Resources\TahunPelajaran;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataPesertaResource extends JsonResource
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
            'nomor_pendaftar' => $this->nomor_pendaftar,
            'nama_lengkap' => $this->nama_lengkap,
            'nisn' => $this->nisn,
            'nik' => $this->nik,
            'provinsi' => $this->provinsi->name,
            'tahun_pelajaran' => $this->tahunPelajaran->tahun_pelajaran,
            'is_pendaftar' => $this->is_pendaftar
        ];
    }
}
