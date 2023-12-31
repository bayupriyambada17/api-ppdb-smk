<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Helpers\ModelHelper;
use App\Models\MandiCuciKakusModel;
use App\Http\Controllers\Controller;
use App\Models\PesertaDidikFisilitasModel;

class MandiCuciKakusController extends Controller
{
    public function all(Request $request)
    {
        $withCountRelationships = $request->input('with_count', ['pesertaDidikFasilitas']);

        return ModelHelper::getAll(MandiCuciKakusModel::class, $withCountRelationships, $request);
    }
    public function store(Request $request)
    {
        return ModelHelper::store(MandiCuciKakusModel::class, $request);
    }
    public function show(string $id)
    {
        return ModelHelper::show(MandiCuciKakusModel::class, $id);
    }
    public function update(Request $request, string $id)
    {
        return ModelHelper::update(MandiCuciKakusModel::class, $request, $id);
    }
    public function destroy(string $id)
    {
        return ModelHelper::destroy(
            MandiCuciKakusModel::class,
            PesertaDidikFisilitasModel::class,
            'mandi_cuci_kakus_id',
            $id
        );
    }
}
