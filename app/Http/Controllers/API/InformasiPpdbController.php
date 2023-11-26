<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\InformasiPpdbModel;
use App\Http\Controllers\Controller;

class InformasiPpdbController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(InformasiPpdbModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(InformasiPpdbModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(InformasiPpdbModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(InformasiPpdbModel::class, $id);
    }
}
