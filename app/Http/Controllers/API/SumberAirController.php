<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\SumberAirModel;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikFisilitasModel;

class SumberAirController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(SumberAirModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(SumberAirModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(SumberAirModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(SumberAirModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            SumberAirModel::class,
            PesertaDidikFisilitasModel::class,
            'sumber_air_id',
            $id
        );
    }
}
