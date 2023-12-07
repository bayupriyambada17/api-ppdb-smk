<?php

namespace Database\Seeders;

use App\Models\TahunLulusModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunLulusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahun = ['2021', '2022', '2023', '2024', '2025'];
        foreach ($tahun as $value) {
            TahunLulusModel::create([
                'tahun' => $value,
                'is_active' => 1
            ]);
        }
    }
}
