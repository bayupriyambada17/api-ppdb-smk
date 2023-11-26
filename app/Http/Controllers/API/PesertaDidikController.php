<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PesertaDidikModel;
use Illuminate\Http\Request;

class PesertaDidikController extends Controller
{
    // TODO

    public function getPendaftarPerhari()
    {
        $perhari = PesertaDidikModel::where("tanggal_terdaftar", '<>', today())->orderBy("tanggal_terdaftar", "desc")->get();
        return response()->json($perhari);
    }
    public function all()
    {
        $pesertaDidik = PesertaDidikModel::with([
            'rapor',
            'fasilitator',
            'fasilitas',
            'riwayatPenyakit',
            'uploadDokumen'
        ])->get();

        return response()->json($pesertaDidik);
    }
}
