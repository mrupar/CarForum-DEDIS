<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;
use App\Models\ForumThread;
use Illuminate\Http\Request;

class ForumThreadController extends Controller
{
    public function create(ForumCategory $category)
    {
        return view('threads.create', compact('category'));
    }

    public function store(Request $request, ForumCategory $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        ForumThread::create([
            'category_id' => $category->id,
            'author_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'date_created' => now(),
        ]);

        return redirect()->route('categories.show', $category)
                         ->with('success', 'Thread created successfully.');
    }

    public function show(ForumThread $thread)
    {
        // Load posts and author relationships
        $thread->load('author', 'posts.author');

        return view('threads.show', compact('thread'));
    }
}
