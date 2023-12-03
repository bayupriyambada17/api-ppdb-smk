<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\KepemilikanKendaraanModel;
use App\Models\PesertaDidikFisilitasModel;

class KepemilikanKendaraanController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(KepemilikanKendaraanModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(KepemilikanKendaraanModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(KepemilikanKendaraanModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(KepemilikanKendaraanModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            KepemilikanKendaraanModel::class,
            PesertaDidikFisilitasModel::class,
            'kepemilikan_kendaraan_id',
            $id
        );
    }
}
