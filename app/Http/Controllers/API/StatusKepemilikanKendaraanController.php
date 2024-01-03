<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikFisilitasModel;
use App\Models\StatusKepemilikanKendaraanModel;

class StatusKepemilikanKendaraanController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(StatusKepemilikanKendaraanModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(StatusKepemilikanKendaraanModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(StatusKepemilikanKendaraanModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(StatusKepemilikanKendaraanModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            StatusKepemilikanKendaraanModel::class,
            PesertaDidikFisilitasModel::class,
            'status_kepemelikan_kendaraan_id',
            $id
        );
    }
}
