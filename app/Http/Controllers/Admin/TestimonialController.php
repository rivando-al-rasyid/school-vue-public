<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the testimonials.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();

        return Inertia::render('Admin/Testimonials/Index', [
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Show the form for creating a new testimonial.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Testimonials/Create');
    }

    /**
     * Store a newly created testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'comment' => 'required|string',
            'avatar' => 'nullable|string',
            'is_active' => 'boolean|nullable',
        ]);

        // Set default values
        $validated['is_active'] = $validated['is_active'] ?? true;

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Show the form for editing the specified testimonial.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Inertia\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return Inertia::render('Admin/Testimonials/Edit', [
            'testimonial' => $testimonial,
        ]);
    }

    /**
     * Update the specified testimonial in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'comment' => 'required|string',
            'avatar' => 'nullable|string',
            'is_active' => 'boolean|nullable',
        ]);

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified testimonial from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }
    
    /**
     * Get active testimonials for the front-end.
     *
     * @param  int  $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveTestimonials($limit = 3)
    {
        $testimonials = Testimonial::where('is_active', true)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
            
        return response()->json($testimonials);
    }
}
