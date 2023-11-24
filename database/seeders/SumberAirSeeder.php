<?php

namespace Database\Seeders;

use App\Models\SumberAirModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SumberAirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Sumur', 'PDAM'];
        foreach ($data as $value) {
            SumberAirModel::create([
                'status' => $value,
            ]);
        }
    }
}
