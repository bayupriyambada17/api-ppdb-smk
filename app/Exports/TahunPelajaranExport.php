<?php

namespace App\Exports;

use App\Models\TahunPelajaranModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class TahunPelajaranExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TahunPelajaranModel::all();
    }
}
