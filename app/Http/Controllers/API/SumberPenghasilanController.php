<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ConstantaHelper;
use App\Models\SumberPenghasilanModel;
use App\Http\Helpers\NotificationStatus;
use Illuminate\Support\Facades\Validator;

class SumberPenghasilanController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(SumberPenghasilanModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(SumberPenghasilanModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(SumberPenghasilanModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(SumberPenghasilanModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            SumberPenghasilanModel::class,
            PesertaDidikFisilitasModel::class,
            'mandi_cuci_kakus_id',
            $id
        );
    }
}
