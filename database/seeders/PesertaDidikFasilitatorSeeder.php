<?php

namespace Database\Seeders;

use App\Models\PesertaDidikFasilitatorModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesertaDidikFasilitatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PesertaDidikFasilitatorModel::create([
            'peserta_didik_id' => 1,
            'nama_fasilitator' => "Bebas",
            'hubungan_calon_siswa_fasilitator' => "Baik",
            'no_whatsapp_fasilitator' => "08129131314141",
            'email_fasilitator' => "email@email.com",
            'informasi_ppdb_id' => 3,
            'saudara_beasiswa_di_smk_fasilitator' => true,
        ]);
    }
}
