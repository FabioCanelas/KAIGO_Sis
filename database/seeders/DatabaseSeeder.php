<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Fabio Canelas',
            'email' => 'admin@kaigo.com',
            'password' => bcrypt('FaBiO_18'), // Tu contraseña será: password
        ]);
    }
}