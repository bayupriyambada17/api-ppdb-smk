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
            'jumlah_peserta' => $this->pesertaDidik->count(),
            'peserta' => DataPesertaResource::collection($this->pesertaDidik),
        ];
    }
}
