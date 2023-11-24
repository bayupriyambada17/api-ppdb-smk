<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Operator PPDB',
            'email' => 'operatorppdb@sekolah.com',
            'password' => Hash::make('operatorppdb123'),
            'status_login' => 'operator'
        ]);
        User::create([
            'name' => 'Operator Pemberkasan',
            'email' => 'pemberkasan@sekolah.com',
            'password' => Hash::make('pemberkasan123'),
            'status_login' => 'berkas'
        ]);
    }
}
