<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Sarah Johnson',
                'role' => 'Parent',
                'comment' => 'The platform has made it so easy to keep track of my child\'s progress and communicate with teachers.',
                'avatar' => 'https://i.pravatar.cc/150?img=32',
                'is_active' => true,
            ],
            [
                'name' => 'Michael Rodriguez',
                'role' => 'Teacher',
                'comment' => 'This system has transformed how I organize my lessons and provide feedback to students.',
                'avatar' => 'https://i.pravatar.cc/150?img=53',
                'is_active' => true,
            ],
            [
                'name' => 'Emily Chen',
                'role' => 'Student',
                'comment' => 'I love how everything I need for my classes is in one place, making it easier to stay organized.',
                'avatar' => 'https://i.pravatar.cc/150?img=44',
                'is_active' => true,
            ],
            [
                'name' => 'David Wilson',
                'role' => 'Administrator',
                'comment' => 'The comprehensive reporting tools have significantly improved our ability to track student performance and make data-driven decisions.',
                'avatar' => 'https://i.pravatar.cc/150?img=12',
                'is_active' => true,
            ],
            [
                'name' => 'Sophia Martinez',
                'role' => 'Parent',
                'comment' => 'Being able to communicate directly with teachers through the platform has strengthened our partnership in supporting my children\'s education.',
                'avatar' => 'https://i.pravatar.cc/150?img=25',
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
