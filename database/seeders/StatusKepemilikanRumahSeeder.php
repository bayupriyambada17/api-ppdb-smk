<?php

namespace Database\Seeders;

use App\Models\StatusKepemilikanRumahModel;
use App\Models\SumberPenghasilanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKepemilikanRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Sendiri', 'Sewa Tahunan', 'Sewa Bulanan', 'Bebas Sewa', 'Rumah Dinas'];
        foreach ($data as $value) {
            StatusKepemilikanRumahModel::create([
                'status' => $value,
            ]);
        }
    }
}
