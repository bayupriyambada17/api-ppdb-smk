<?php

namespace Database\Seeders;

use App\Models\PendidikanTerakhirModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanTerakhirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['S3', 'S2', 'S1', 'SMA/Sederajat', 'SMP/Sederajat', 'SD/Sederajat', 'Tidak Pendidikan'];
        foreach ($data as $value) {
            PendidikanTerakhirModel::create([
                'status' => $value,
            ]);
        }
    }
}
