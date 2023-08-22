<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // buat data admin.
        \App\Models\User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'no_telp' => '0000000000',
            'password' => bcrypt('password'),
            'hak_akses' => 'ADMIN'
        ]);
    }
}
