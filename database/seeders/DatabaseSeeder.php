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
        User::factory()->create([
            'name' => 'Pedro Sanxes',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
    }
}
