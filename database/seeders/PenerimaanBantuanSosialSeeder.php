<?php

namespace Database\Seeders;

use App\Models\PenerimaanBantuanSosialModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenerimaanBantuanSosialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Kartu Perlindungan Sosial (KPS)', 'Kartu Indonesia Pintar (KIP)', 'Kartu Indonesia Sehat (KIS)', 'Program Keluarga Harapan (PKH)'];
        foreach ($data as $value) {
            PenerimaanBantuanSosialModel::create([
                'status' => $value,
            ]);
        }
    }
}
