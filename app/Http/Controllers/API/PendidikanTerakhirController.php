<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\PendidikanTerakhirModel;
use App\Models\PesertaDidikModel;

class PendidikanTerakhirController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikPendidikanAyah', 'pesertaDidikPendidikanIbu']);

        return ModelHelper::getAll(PendidikanTerakhirModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(PendidikanTerakhirModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(PendidikanTerakhirModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(PendidikanTerakhirModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            PendidikanTerakhirModel::class,
            PesertaDidikModel::class,
            'pendidikan_terakhir_ayah_id',
            $id
        );
    }
}
