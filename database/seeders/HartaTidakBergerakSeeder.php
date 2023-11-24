<?php

namespace Database\Seeders;

use App\Models\HartaTidakBergerakModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HartaTidakBergerakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Sawah', 'Ladang', 'Tanah', 'Kolam', 'Tidak ada'];
        foreach ($data as $value) {
            HartaTidakBergerakModel::create([
                'status' => $value,
            ]);
        }
    }
}
