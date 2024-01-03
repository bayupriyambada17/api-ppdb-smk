<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikFisilitasModel;
use App\Models\StatusKepemilikanHartaTidakBergerakModel;

class StatusHartaTidakBergerakController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(StatusKepemilikanHartaTidakBergerakModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(StatusKepemilikanHartaTidakBergerakModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(StatusKepemilikanHartaTidakBergerakModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(StatusKepemilikanHartaTidakBergerakModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            StatusKepemilikanHartaTidakBergerakModel::class,
            PesertaDidikFisilitasModel::class,
            'status_kepemelikan_htb_id',
            $id
        );
    }
}
