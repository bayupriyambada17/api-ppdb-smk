<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\KeadaanOrangTuaModel;
use App\Models\PesertaDidikModel;

class KeadanOrangTuaController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidik']);

        return ModelHelper::getAll(KeadaanOrangTuaModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(KeadaanOrangTuaModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(KeadaanOrangTuaModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(KeadaanOrangTuaModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            KeadaanOrangTuaModel::class,
            PesertaDidikModel::class,
            'keadaan_orang_tua_id',
            $id
        );
    }
}
