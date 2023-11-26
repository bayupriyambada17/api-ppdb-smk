<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\StatusDalamKeluargaModel;

class StatusDalamKeluargaController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(StatusDalamKeluargaModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(StatusDalamKeluargaModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(StatusDalamKeluargaModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(StatusDalamKeluargaModel::class, $id);
    }
}
