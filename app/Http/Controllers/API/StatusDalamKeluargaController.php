<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikModel;
use App\Models\StatusDalamKeluargaModel;

class StatusDalamKeluargaController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidik']);

        return ModelHelper::getAll(StatusDalamKeluargaModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(StatusDalamKeluargaModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(StatusDalamKeluargaModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(StatusDalamKeluargaModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            StatusDalamKeluargaModel::class,
            PesertaDidikModel::class,
            'status_dalam_keluarga_id',
            $id
        );
    }
}
