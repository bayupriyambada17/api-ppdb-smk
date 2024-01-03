<?php

namespace App\Http\Resources\ExportResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ExportResource\ProvinsiResource\PesertaDidik;

class ProvinsiResource extends JsonResource
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
            'name' => $this->name,
            'jumlah_peserta' => $this->pesertaDidik->count(),
            'data' =>
            [
                'tahun_pelajaran' => $this->pesertaDidik->pluck('tahunPelajaran.tahun_pelajaran')->first(),
                'peserta' => PesertaDidik::collection($this->whenLoaded("pesertaDidik")),
            ]
        ];
    }
}
