<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\LuasTanahModel;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikFisilitasModel;

class LuasTanahController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(LuasTanahModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(LuasTanahModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(LuasTanahModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(LuasTanahModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            LuasTanahModel::class,
            PesertaDidikFisilitasModel::class,
            'luas_tanah_id',
            $id
        );
    }
}
