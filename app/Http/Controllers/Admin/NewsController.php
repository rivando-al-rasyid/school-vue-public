<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();

        return Inertia::render('Admin/News/Index', [
            'news' => $news,
        ]);
    }

    /**
     * Show the form for creating a new news article.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/News/Create');
    }

    /**
     * Store a newly created news article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'is_published' => 'boolean|nullable',
        ]);

        // Set default values
        $validated['is_published'] = $validated['is_published'] ?? true;

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article created successfully.');
    }

    /**
     * Show the form for editing the specified news article.
     *
     * @param  \App\Models\News  $news
     * @return \Inertia\Response
     */
    public function edit(News $news)
    {
        return Inertia::render('Admin/News/Edit', [
            'news' => $news,
        ]);
    }

    /**
     * Update the specified news article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'is_published' => 'boolean|nullable',
        ]);

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article updated successfully.');
    }

    /**
     * Remove the specified news article from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News article deleted successfully.');
    }
    
    /**
     * Get latest news for the front-end.
     *
     * @param  int  $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLatestNews($limit = 3)
    {
        $news = News::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
            
        return response()->json($news);
    }
}
