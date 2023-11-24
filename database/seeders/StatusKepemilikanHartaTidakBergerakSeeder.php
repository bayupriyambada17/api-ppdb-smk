<?php

namespace Database\Seeders;

use App\Models\StatusKepemilikanHartaTidakBergerakModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKepemilikanHartaTidakBergerakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Beli', 'Sewa', 'Warisan', 'Hibah', 'Tidak ada'];
        foreach ($data as $value) {
            StatusKepemilikanHartaTidakBergerakModel::create([
                'status' => $value,
            ]);
        }
    }
}
