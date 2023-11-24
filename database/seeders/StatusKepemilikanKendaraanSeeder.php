<?php

namespace Database\Seeders;

use App\Models\StatusKepemilikanKendaraanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKepemilikanKendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Beli', 'Sewa', 'Warisan', 'Hibah', 'Tidak ada'];
        foreach ($data as $value) {
            StatusKepemilikanKendaraanModel::create([
                'status' => $value,
            ]);
        }
    }
}
