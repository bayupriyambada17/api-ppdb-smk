<?php

namespace Database\Seeders;

use App\Models\PesertaDidikFisilitasModel;
use Illuminate\Database\Seeder;

class PesertaDidikFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PesertaDidikFisilitasModel::create([
            'peserta_didik_id' => 1,
            'status_kepemilikan_rumah_id' => 1,
            'tahun_perolehan_status_kepemilikan' => (int) 2022,
            'kualitas_rumah_id' => 2,
            'luas_tanah_id' => 2,
            'mandi_cuci_kakus_id' => 1,
        ]);
    }
}
