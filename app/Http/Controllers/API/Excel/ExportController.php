<?php

namespace App\Http\Controllers\API\Excel;

use Illuminate\Http\Request;
use App\Models\ProvinsiModel;
use App\Models\TahunPelajaranModel;
use App\Http\Controllers\Controller;
use App\Exports\TahunPelajaranExport;
use App\Http\Resources\ExportResource\ProvinsiResource;

class ExportController extends Controller
{
    public function exportTahunPelajaranById(int $id)
    {
        // TODO
    }

    public function exportTahunLulusById(Request $request)
    {
        // TODO
    }

    public function exportProvinsiUserTerimaId(int $id)
    {
        $provinsi = ProvinsiModel::with(["pesertaDidik" => function ($query) {
            $query->where("is_pendaftar", 'diterima');
        }])->find($id);

        if (!$provinsi) {
            return response()->json(['error' => 'Provinsi not found'], 404);
        }

        return new ProvinsiResource($provinsi);
    }
}
