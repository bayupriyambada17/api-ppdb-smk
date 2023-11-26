<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\MandiCuciKakusModel;
use App\Http\Controllers\Controller;

class MandiCuciKakusController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(MandiCuciKakusModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(MandiCuciKakusModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(MandiCuciKakusModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(MandiCuciKakusModel::class, $id);
    }
}
