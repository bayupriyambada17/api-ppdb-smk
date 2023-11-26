<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\KeadaanOrangTuaModel;

class KeadanOrangTuaController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(KeadaanOrangTuaModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(KeadaanOrangTuaModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(KeadaanOrangTuaModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(KeadaanOrangTuaModel::class, $id);
    }
}
