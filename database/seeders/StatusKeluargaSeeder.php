<?php

namespace Database\Seeders;

use App\Models\StatusDalamKeluargaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Anak Kandung', 'Anak Tiri', 'Anak Angkat'];
        foreach ($data as $value) {
            StatusDalamKeluargaModel::create([
                'status' => $value,
            ]);
        }
    }
}
