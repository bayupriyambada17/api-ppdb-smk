<?php

namespace Database\Seeders;

use App\Models\TinggalBersamaStatusModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TinggalBersamaStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Orang Tua', 'Kakek/Nenek', 'Saudara Kandung', 'Panti/Pondok Pesantren', 'wali'];
        foreach ($data as $value) {
            TinggalBersamaStatusModel::create([
                'status' => $value,
            ]);
        }
    }
}
