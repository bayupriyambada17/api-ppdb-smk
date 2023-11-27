<?php

namespace Database\Seeders;

use App\Models\ProvinsiModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getProvinsi = File::get(public_path('json/provinsi.json'));
        $data = json_decode($getProvinsi);

        foreach ($data as $item) {
            ProvinsiModel::create([
                'name' => $item->name,
            ]);
        }
    }
}
