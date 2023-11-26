<?php

namespace Database\Seeders;

use App\Models\PesertaDidikRaporModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesertaDidikRaporSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PesertaDidikRaporModel::create([
            'peserta_didik_id' => 1,
            'rapor_matematika_3' => 5,
            'rapor_matematika_4' => 5,
            'rapor_matematika_5' => 5,
            'rapor_ipa_3' => 5,
            'rapor_ipa_4' => 5,
            'rapor_ipa_5' => 5,
        ]);
    }
}
