<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\HartaTidakBergerakModel;
class HartaTidakBergerakController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(HartaTidakBergerakModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(HartaTidakBergerakModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(HartaTidakBergerakModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(HartaTidakBergerakModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            HartaTidakBergerakModel::class,
            PesertaDidikFisilitasModel::class,
            'harta_tidak_bergerak_id',
            $id
        );
    }
}
