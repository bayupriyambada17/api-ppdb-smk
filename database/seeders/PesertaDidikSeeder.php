<?php

namespace Database\Seeders;

use App\Models\PesertaDidikModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesertaDidikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PesertaDidikModel::create([
            'tahun_pelajaran_id' => 1,
            'nama_lengkap' => 'Random',
            'nisn' => '12313142141',
            'nik' => '1241412141',
            'tempat_lahir' => 'Random',
            'tanggal_lahir' => 'Random',
            'alamat' => 'Random',
            'provinsi' => 'Random',
            'kota_kabupaten' => 'Random',
            'no_whatsapp_telp' => 'Random',
            'sosial_media' => 'Random',
            'tanggal_terdaftar' => now(),
        ]);
        PesertaDidikModel::create([
            'tahun_pelajaran_id' => 1,
            'nama_lengkap' => 'Random 1',
            'nisn' => '12313142142',
            'nik' => '1241412142',
            'tempat_lahir' => 'Random',
            'tanggal_lahir' => 'Random',
            'alamat' => 'Random',
            'provinsi' => 'Random',
            'kota_kabupaten' => 'Random',
            'no_whatsapp_telp' => 'Random',
            'sosial_media' => 'Random',
            'tanggal_terdaftar' => now(),
        ]);
    }
}
