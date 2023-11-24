<?php

namespace Database\Seeders;

use App\Models\KeadaanOrangTuaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeadaanOrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Orang Tua Saya Lengkap', 'Saya Yatim', 'Saya Piatu', 'Saya Yatim Piatu'];
        foreach ($data as $value) {
            KeadaanOrangTuaModel::create([
                'status' => $value,
            ]);
        }
    }
}
