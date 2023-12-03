<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\InformasiPpdbModel;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikFasilitatorModel;

class InformasiPpdbController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitator']);

        return ModelHelper::getAll(InformasiPpdbModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(InformasiPpdbModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(InformasiPpdbModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(InformasiPpdbModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            InformasiPpdbModel::class,
            PesertaDidikFasilitatorModel::class,
            'informasi_ppdb_id',
            $id
        );
    }
}
