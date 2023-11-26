<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\KepemilikanKendaraanModel;

class KepemilikanKendaraanController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(KepemilikanKendaraanModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(KepemilikanKendaraanModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(KepemilikanKendaraanModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(KepemilikanKendaraanModel::class, $id);
    }
}
