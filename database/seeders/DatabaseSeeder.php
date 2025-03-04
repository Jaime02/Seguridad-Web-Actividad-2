<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Crea los usuarios de prueba
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Pedro Sanxes',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'description' => 'Soy el que manda neng',
            'phone' => '1234567890',
        ]);
    }
}
