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
            'name' => 'Administrador Kivo',
            'email' => 'admin@kivo.com',
            'password' => bcrypt('password'), // Tu contraseña será: password
        ]);
    }
}