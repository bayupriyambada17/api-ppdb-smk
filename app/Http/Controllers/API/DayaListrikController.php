<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\DayaListrikModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ModelHelper;
use App\Models\PesertaDidikFisilitasModel;

class DayaListrikController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(DayaListrikModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(DayaListrikModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(DayaListrikModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(DayaListrikModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            DayaListrikModel::class,
            PesertaDidikFisilitasModel::class,
            'daya_listrik_id',
            $id
        );
    }
}
