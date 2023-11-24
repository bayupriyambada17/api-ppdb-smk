<?php

namespace Database\Seeders;

use App\Models\GolonganDarahModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['A ', 'B ', 'AB ', '0 ', '-'];
        foreach ($data as $value) {
            GolonganDarahModel::create([
                'status' => $value
            ]);
        }
    }
}
