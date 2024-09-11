<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Link;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'id' => 2,
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => bcrypt('password2'),
        ]);

        Link::create([
            'user_id' => 1,
            'name' => 'Google',
            'url' => 'https://www.google.com',
            'subtitle' => 'Search engine',
            'place' => 1,
        ]);

        Link::create([
            'user_id' => 1,
            'name' => 'YouTube',
            'url' => 'https://www.youtube.com',
            'subtitle' => 'Video sharing platform',
            'place' => 2,
        ]);
    }
}
