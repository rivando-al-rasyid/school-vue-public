<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'src' => 'https://images.unsplash.com/photo-1588072432836-e10032774350',
                'alt' => 'Modern Education',
                'caption' => 'Empower Your Education Journey',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'src' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1',
                'alt' => 'Learning Experience',
                'caption' => 'Innovative Learning Experience',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'src' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7',
                'alt' => 'Student Success',
                'caption' => 'Supporting Student Success',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}
