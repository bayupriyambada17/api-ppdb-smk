<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\PesertaDidikModel;
use App\Http\Controllers\Controller;
use App\Models\TinggalBersamaStatusModel;

class TinggalBersamaController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidik']);

        return ModelHelper::getAll(TinggalBersamaStatusModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(TinggalBersamaStatusModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(TinggalBersamaStatusModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(TinggalBersamaStatusModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            TinggalBersamaStatusModel::class,
            PesertaDidikModel::class,
            'tinggal_bersama_status_id',
            $id
        );
    }
}
