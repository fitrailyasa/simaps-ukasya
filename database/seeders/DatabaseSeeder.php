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
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GelanggangSeeder::class);
        $this->call(TandingSeeder::class);
        $this->call(TGRSeeder::class);
        // $this->call(PengundianTandingSeeder::class);
        // $this->call(PengundianTGRSeeder::class);
        // $this->call(JadwalTandingSeeder::class);
        // $this->call(JadwalTGRSeeder::class);
    }
}
