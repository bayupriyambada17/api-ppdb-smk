<?php

namespace Database\Seeders;

use App\Models\DayaListrikModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayaListrikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['450 ', '900 ', '1300 ', '>1300 ', 'Tidak Ada'];
        foreach ($data as $value) {
            DayaListrikModel::create([
                'status' => $value . " kWh"
            ]);
        }
    }
}
