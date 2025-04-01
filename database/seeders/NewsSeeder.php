<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsItems = [
            [
                'title' => 'New Curriculum Updates',
                'description' => 'Exciting changes to our educational programs',
                'content' => 'We are thrilled to announce a comprehensive update to our curriculum, focusing on modern educational needs and skill development. The new curriculum introduces more project-based learning and practical applications, preparing students for real-world challenges.',
                'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b',
                'is_published' => true,
            ],
            [
                'title' => 'Campus Expansion Project',
                'description' => 'Construction begins on new facilities',
                'content' => 'Our campus expansion project has officially begun! The new facilities will include state-of-the-art laboratories, a larger library, and modern sports facilities. This expansion will significantly enhance the learning environment for all students.',
                'image' => 'https://images.unsplash.com/photo-1505238680356-667803448bb6',
                'is_published' => true,
            ],
            [
                'title' => 'Award-Winning Faculty Joins',
                'description' => 'Welcome to our new professors and staff',
                'content' => 'We are proud to announce that several award-winning educators have joined our faculty. Their expertise and innovative teaching methods will bring fresh perspectives to our school community and enhance the educational experience for all students.',
                'image' => 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655',
                'is_published' => true,
            ],
        ];

        foreach ($newsItems as $item) {
            News::create($item);
        }
    }
}
