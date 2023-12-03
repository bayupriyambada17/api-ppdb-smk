<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\PesertaDidikModel;
use App\Http\Controllers\Controller;
use App\Models\PenerimaanBantuanSosialModel;

class PenerimaanBantuanSosialController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidik']);

        return ModelHelper::getAll(PenerimaanBantuanSosialModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(PenerimaanBantuanSosialModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(PenerimaanBantuanSosialModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(PenerimaanBantuanSosialModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            PenerimaanBantuanSosialModel::class,
            PesertaDidikModel::class,
            'penerimaan_bantuan_sosial_id',
            $id
        );
    }
}
