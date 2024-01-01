<?php

namespace App\Http\Resources\DataPublic;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TahunPelajaranActiveResource extends JsonResource
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
            'is_active' => $this->is_active,
        ];
    }
}
