<?php

namespace Database\Seeders;

use App\Models\TahunPelajaranModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunPelajaranDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahun = ['2022/2023', '2023/2024', '2024/2025'];
        foreach ($tahun as $value) {
            TahunPelajaranModel::create([
                'tahun_pelajaran' => $value,
                'is_active' => 1
            ]);
        }
    }
}
