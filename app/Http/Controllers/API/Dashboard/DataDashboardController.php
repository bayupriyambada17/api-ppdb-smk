<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ProvinsiModel;
use App\Models\TahunPelajaranModel;

class DataDashboardController extends Controller
{
    public function getTotalPesertaDidik()
    {
        $total = TahunPelajaranModel::select('id', 'tahun_pelajaran', 'isActive')->withCount('pesertaDidik')->get();
        return response()->json($total);
    }
    public function getProvinsi()
    {
        $provinsi = ProvinsiModel::select('id', 'name')->withCount("pesertaDidik")->get();
        return response()->json($provinsi);
    }
}
