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
        // Seed roles and users, then example player notes
        $this->call([
            RolesAndUsersSeeder::class,
            PlayerNotesSeeder::class,
        ]);
    }
}
