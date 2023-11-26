<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\HartaTidakBergerakModel;
class HartaTidakBergerakController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(HartaTidakBergerakModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(HartaTidakBergerakModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(HartaTidakBergerakModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(HartaTidakBergerakModel::class, $id);
    }
}
