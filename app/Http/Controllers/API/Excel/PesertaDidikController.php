<?php

namespace App\Http\Controllers\API\Excel;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\PesertaDidikExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PesertaDidikController extends Controller
{
    public function getPesertaDidikDiProsesExport()
    {
        $timestamp = Carbon::now()->format('Ymd_His');
        $filename = "peserta-proses-waktusaatini_{$timestamp}.xlsx";
        return Excel::download(new PesertaDidikExport, $filename);
    }
}
