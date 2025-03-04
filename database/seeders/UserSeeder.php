<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Create the initial users
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Pedro Sanxes',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'description' => 'Soy el que manda neng',
            'phone' => '1234567890',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Pepe Usu Ario',
            'email' => 'pepe@hotmail.com',
            'password' => bcrypt('pepepepe'),
            'description' => 'Soy un soldado raso',
            'phone' => '6699669969',
        ]);
    }
}
