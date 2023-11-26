<?php

namespace Database\Seeders;

use App\Models\PesertaDidikRiwayatModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesertaDidikRiwayatSeeder extends Seeder
{
    public function run(): void
    {
        PesertaDidikRiwayatModel::create([
            'peserta_didik_id' => 1,
            'tinggi_badan' => 185,
            'berat_badan' => 55,
            'penyakit_di_derita' => "Penyakit",
            'penyakit_menular' => "Tidak Ada",
            'golongan_darah_id' => 1,
            'perokok' => 0,
            'buta_warna' => 0,
            'asuransi_bpjs_kis' => 0,
        ]);
    }
}
