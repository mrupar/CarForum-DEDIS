<?php

namespace App\Http\Controllers;

use App\Models\ForumThread;
use App\Models\ForumPost;
use Illuminate\Http\Request;

class ForumPostController extends Controller
{
    public function store(Request $request, ForumThread $thread)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        ForumPost::create([
            'thread_id' => $thread->id,
            'author_id' => auth()->id(),
            'content' => $request->content,
            'date_created' => now(),
        ]);

        return redirect()->route('threads.show', $thread)
                         ->with('success', 'Post added successfully.');
    }
}
