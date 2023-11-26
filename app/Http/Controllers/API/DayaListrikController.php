<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\DayaListrikModel;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ModelHelper;

class DayaListrikController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(DayaListrikModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(DayaListrikModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(DayaListrikModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(DayaListrikModel::class, $id);
    }
}
