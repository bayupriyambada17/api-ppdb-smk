<?php

namespace App\Http\Resources\ExportResource\ProvinsiResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PesertaDidik extends JsonResource
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
            'tahun_pelajaran' => $this->tahun_pelajaran_id,
            'is_pendaftar' => $this->is_pendaftar,
            'rapor' =>  $this->rapor
        ];
    }
}
