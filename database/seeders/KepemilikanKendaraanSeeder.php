<?php

namespace Database\Seeders;

use App\Models\KepemilikanKendaraanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepemilikanKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Motor', 'Mobil', 'Becak', 'Roda 3', 'Tidak Ada'];
        foreach ($data as $value) {
            KepemilikanKendaraanModel::create([
                'status' => $value,
            ]);
        }
    }
}
