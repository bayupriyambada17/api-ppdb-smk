<?php

namespace App\Exports;

use App\Models\PesertaDidikModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PesertaDidikExport implements FromCollection, WithChunkReading
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PesertaDidikModel::where("is_pendaftar", "proses")->get();
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
