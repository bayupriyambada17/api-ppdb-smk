<?php

namespace Database\Seeders;

use App\Models\LuasTanahModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LuasTanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['<25', '25-50', '50-99', '100-200', '>200'];
        foreach ($data as $value) {
            LuasTanahModel::create([
                'status' => $value . " m2",
            ]);
        }
    }
}
