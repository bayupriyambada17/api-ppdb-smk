<?php

namespace Database\Seeders;

use App\Models\SumberPenghasilanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SumberPenghasilanDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Kakak', 'Saudara', 'Kakek', 'Nenek', 'Kerabat'];
        foreach ($data as $value) {
            SumberPenghasilanModel::create([
                'status' => $value,
            ]);
        }
    }
}
