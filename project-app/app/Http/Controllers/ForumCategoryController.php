<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Forum\BaseForumController;
use App\Models\ForumCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class ForumCategoryController extends BaseForumController
{

    public function create()
    {
        return view('categories.create');
    }

    public function show(ForumCategory $category)
    {
        $threads = $category->threads()
            ->with('author')
            ->withCount('posts')
            ->latest()
            ->get();

        return view('categories.show', compact('category', 'threads'));
    }

    public function edit(ForumCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    /* =========================
     | TEMPLATE HOOKS
     |=========================*/

    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
    }

    protected function createModel(array $data, $context = null): Model
    {
        return ForumCategory::create([
            ...$data,
            'date_created' => now(),
        ]);
    }
    protected function authorizeAction(string $ability, ?Model $model = null): void
    {
        // Policy-ready
        // $this->authorize($ability, $model ?? ForumCategory::class);
    }

    protected function redirectAfterStore(Model $model)
    {
        return redirect()->route('categories.show', $model);
    }

    protected function redirectAfterUpdate(Model $model)
    {
        return redirect()->route('categories.show', $model);
    }

    protected function redirectAfterDelete()
    {
        return redirect()->route('dashboard');
    }
}
