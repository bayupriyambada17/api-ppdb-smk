<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\KualitasRumahModel;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikFisilitasModel;

class KualitaRumahController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(KualitasRumahModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(KualitasRumahModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(KualitasRumahModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(KualitasRumahModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            KualitasRumahModel::class,
            PesertaDidikFisilitasModel::class,
            'kualitas_rumah_id',
            $id
        );
    }
}
