<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use App\Models\Slide;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the home page with required data
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $slides = Slide::where('is_active', true)->orderBy('order')->get();
        $events = Event::where('is_active', true)->where('date', '>=', now())->orderBy('date')->get();
        $news = News::where('is_published', true)->orderBy('created_at', 'desc')->get();
        $testimonials = Testimonial::where('is_active', true)->inRandomOrder()->get();
        return Inertia::render('home/index', [
            'slides' => $slides,
            'events' => $events,
            'news' => $news,
            'testimonials' => $testimonials,
        ]);
    }

}
