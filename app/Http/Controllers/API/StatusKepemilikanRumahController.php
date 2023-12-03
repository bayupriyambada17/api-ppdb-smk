<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikFisilitasModel;
use App\Models\StatusKepemilikanRumahModel;

class StatusKepemilikanRumahController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(StatusKepemilikanRumahModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(StatusKepemilikanRumahModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(StatusKepemilikanRumahModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(StatusKepemilikanRumahModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            StatusKepemilikanRumahModel::class,
            PesertaDidikFisilitasModel::class,
            'status_kepemilikan_rumah_id',
            $id
        );
    }
}
