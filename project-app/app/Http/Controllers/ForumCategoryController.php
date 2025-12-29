<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumCategory;

class ForumCategoryController extends Controller
{
    public function show(ForumCategory $category)
    {
        // Load threads with authors and post count
        $threads = $category->threads()
            ->with('author')
            ->withCount('posts')
            ->orderByDesc('date_created')
            ->get();

        return view('categories.show', compact('category', 'threads'));
    }

    public function create()
    {
        return view('categories.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
    
        \App\Models\ForumCategory::create([
            'title' => $request->title,
            'content' => $request->content,
            'date_created' => now(),
        ]);
    
        return redirect()->route('dashboard')
            ->with('success', 'Category created successfully.');
    }
    
}
