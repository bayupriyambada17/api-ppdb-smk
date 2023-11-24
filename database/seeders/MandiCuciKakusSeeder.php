<?php

namespace Database\Seeders;

use App\Models\MandiCuciKakusModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MandiCuciKakusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Kepemilikan sendiri di dalam rumah', 'Kepemilikan sendiri di luar rumah', 'Berbagi pakai'];
        foreach ($data as $value) {
            MandiCuciKakusModel::create([
                'status' => $value,
            ]);
        }
    }
}
