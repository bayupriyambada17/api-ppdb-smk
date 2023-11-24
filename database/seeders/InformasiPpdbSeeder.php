<?php

namespace Database\Seeders;

use App\Models\InformasiPpdbModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformasiPpdbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Whatsapp ', 'Website ', 'Instagram ', 'Kerabat '];
        foreach ($data as $value) {
            InformasiPpdbModel::create([
                'status' => $value
            ]);
        }
    }
}
