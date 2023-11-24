<?php

namespace Database\Seeders;

use App\Models\KualitasRumahModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KualitasRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Layak Huni', 'Setengah Layak Huni', 'Tidak Layak Huni'];
        foreach ($data as $value) {
            KualitasRumahModel::create([
                'status' => $value,
            ]);
        }
    }
}
