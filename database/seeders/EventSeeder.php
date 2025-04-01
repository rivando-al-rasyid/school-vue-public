<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'End of Year Ceremony',
                'date' => '2025-05-25',
                'description' => 'Annual ceremony celebrating student achievements',
                'location' => 'Main Auditorium',
                'is_active' => true,
            ],
            [
                'title' => 'Science Fair',
                'date' => '2025-04-15',
                'description' => 'Student projects and scientific innovations',
                'location' => 'Science Building',
                'is_active' => true,
            ],
            [
                'title' => 'Parent-Teacher Meeting',
                'date' => '2025-04-10',
                'description' => 'Discuss student progress and performance',
                'location' => 'Conference Hall',
                'is_active' => true,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
