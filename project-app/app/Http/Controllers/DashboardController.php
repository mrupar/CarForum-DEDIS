<?php

namespace App\Http\Controllers;

use App\Models\ForumCategory;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = ForumCategory::withCount('threads')
            ->orderBy('title')
            ->get();

        return view('dashboard', compact('categories'));
    }
}
