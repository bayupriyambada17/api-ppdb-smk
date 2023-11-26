<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Models\PenerimaanBantuanSosialModel;

class PenerimaanBantuanSosialController extends Controller
{
    public function all(Request $request)
    {
        return ModelHelper::getAll(PenerimaanBantuanSosialModel::class, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(PenerimaanBantuanSosialModel::class, $request);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(PenerimaanBantuanSosialModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(PenerimaanBantuanSosialModel::class, $id);
    }
}
