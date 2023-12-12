<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\GolonganDarahModel;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikRiwayatModel;

class GolonganDarahController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaRiwayat']);

        return ModelHelper::getAll(GolonganDarahModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(GolonganDarahModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(GolonganDarahModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(GolonganDarahModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            GolonganDarahModel::class,
            PesertaDidikRiwayatModel::class,
            'golongan_darah_id',
            $id
        );
    }
}
