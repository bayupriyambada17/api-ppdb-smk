<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\GolonganDarahModel;
use App\Http\Controllers\Controller;

class GolonganDarahController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(GolonganDarahModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(GolonganDarahModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(GolonganDarahModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(GolonganDarahModel::class, $id);
    }
}
