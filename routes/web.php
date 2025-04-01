<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\TestimonialController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // Slides Management
    Route::resource('slides', SlideController::class);
    Route::post('slides/order', [SlideController::class, 'updateOrder'])->name('slides.order');
    
    // Events Management
    Route::resource('events', EventController::class);
    
    // News Management
    Route::resource('news', NewsController::class);
    
    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);
});

// API routes for public data
Route::prefix('api')->name('api.')->group(function () {
    Route::get('events/upcoming/{limit?}', [EventController::class, 'getUpcomingEvents'])->name('events.upcoming');
    Route::get('news/latest/{limit?}', [NewsController::class, 'getLatestNews'])->name('news.latest');
    Route::get('testimonials/active/{limit?}', [TestimonialController::class, 'getActiveTestimonials'])->name('testimonials.active');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
