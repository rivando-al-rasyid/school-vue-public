<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SlideController extends Controller
{
    /**
     * Display a listing of the slides.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $slides = Slide::orderBy('order')->get();

        return Inertia::render('Admin/Slides/Index', [
            'slides' => $slides,
        ]);
    }

    /**
     * Show the form for creating a new slide.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Slides/Create');
    }

    /**
     * Store a newly created slide in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'src' => 'required|string',
            'alt' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'order' => 'integer|nullable',
            'is_active' => 'boolean|nullable',
        ]);

        // Set default values
        $validated['order'] = $validated['order'] ?? Slide::max('order') + 1;
        $validated['is_active'] = $validated['is_active'] ?? true;

        Slide::create($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide created successfully.');
    }

    /**
     * Show the form for editing the specified slide.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Inertia\Response
     */
    public function edit(Slide $slide)
    {
        return Inertia::render('Admin/Slides/Edit', [
            'slide' => $slide,
        ]);
    }

    /**
     * Update the specified slide in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Slide $slide)
    {
        $validated = $request->validate([
            'src' => 'required|string',
            'alt' => 'required|string|max:255',
            'caption' => 'required|string|max:255',
            'order' => 'integer|nullable',
            'is_active' => 'boolean|nullable',
        ]);

        $slide->update($validated);

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide updated successfully.');
    }

    /**
     * Remove the specified slide from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();

        return redirect()->route('admin.slides.index')
            ->with('success', 'Slide deleted successfully.');
    }

    /**
     * Update the order of slides.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'slides' => 'required|array',
            'slides.*.id' => 'required|integer|exists:slides,id',
            'slides.*.order' => 'required|integer',
        ]);

        foreach ($request->slides as $slideData) {
            Slide::find($slideData['id'])->update(['order' => $slideData['order']]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }
}
