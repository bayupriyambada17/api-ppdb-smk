<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\LuasTanahSeeder;
use Database\Seeders\SumberAirSeeder;
use App\Models\SumberPenghasilanModel;
use Database\Seeders\TahunLulusSeeder;
use Database\Seeders\DayaListrikSeeder;
use Database\Seeders\KualitasRumahSeeder;
use Database\Seeders\MandiCuciKakusSeeder;
use Database\Seeders\StatusKeluargaSeeder;
use Database\Seeders\KeadaanOrangTuaSeeder;
use Database\Seeders\HartaTidakBergerakSeeder;
use Database\Seeders\TahunPelajaranDataSeeder;
use Database\Seeders\KepemilikanKendaraanSeeder;
use Database\Seeders\TinggalBersamaStatusSeeder;
use Database\Seeders\StatusKepemilikanRumahSeeder;
use Database\Seeders\PenerimaanBantuanSosialSeeder;
use Database\Seeders\StatusKepemilikanKendaraanSeeder;
use Database\Seeders\StatusKepemilikanHartaTidakBergerakSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersDataSeeder::class,
            TahunLulusSeeder::class,
            TahunPelajaranDataSeeder::class,
            KeadaanOrangTuaSeeder::class,
            PenerimaanBantuanSosialSeeder::class,
            StatusKeluargaSeeder::class,
            TinggalBersamaStatusSeeder::class,
            SumberPenghasilanDataSeeder::class,
            StatusKepemilikanRumahSeeder::class,
            KualitasRumahSeeder::class,
            LuasTanahSeeder::class,
            MandiCuciKakusSeeder::class,
            SumberAirSeeder::class,
            DayaListrikSeeder::class,
            KepemilikanKendaraanSeeder::class,
            StatusKepemilikanKendaraanSeeder::class,
            HartaTidakBergerakSeeder::class,
            StatusKepemilikanHartaTidakBergerakSeeder::class,

        ]);
    }
}
