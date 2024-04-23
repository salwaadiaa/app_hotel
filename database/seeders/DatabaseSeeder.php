<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@material.com',
            'role' => 'admin',
            'password' => ('secret')
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@material.com',
            'role' => 'user',
            'password' => ('secret')
        ]);
    }
}
