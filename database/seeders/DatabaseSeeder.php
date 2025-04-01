<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\SlideSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\NewsSeeder;
use Database\Seeders\TestimonialSeeder;
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
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        (new SlideSeeder())->run();
        (new EventSeeder())->run();
        (new NewsSeeder())->run();
        (new TestimonialSeeder())->run();
    }
}
