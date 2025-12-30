<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Forum\BaseForumController;
use App\Models\ForumCategory;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ForumThreadController extends BaseForumController
{
    /* =========================================================
     | READ METHODS (NOT TEMPLATED)
     |=========================================================*/

    public function create(ForumCategory $category)
    {
        return view('threads.create', compact('category'));
    }

    public function show(ForumThread $thread)
    {
        $thread->load('author', 'posts.author');

        return view('threads.show', compact('thread'));
    }

    public function edit(ForumThread $thread)
    {
        return view('threads.edit', compact('thread'));
    }

    /* =========================================================
     | TEMPLATE METHODS USAGE
     |=========================================================*/

    // Update thread
    public function updateThread(Request $request, ForumThread $thread)
    {
        return $this->update($request, $thread);
    }

    // Delete thread
    public function destroyThread(ForumThread $thread)
    {
        return $this->destroy($thread);
    }

    /* =========================================================
     | TEMPLATE HOOK IMPLEMENTATION
     |=========================================================*/

    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
    }

    protected function createModel(array $data, ...$context): Model
    {
        /** @var ForumCategory $category */
        $category = $context[0] ?? request()->route('category');

        if (!$category instanceof ForumCategory) {
            $category = ForumCategory::findOrFail($category);
        }

        return ForumThread::create([
            'category_id'  => $category->id,
            'author_id'    => auth()->id(),
            'title'        => $data['title'],
            'content'      => $data['content'] ?? null,
            'date_created' => now(),
        ]);
    }

    protected function authorizeAction(string $ability, ?Model $model = null): void
    {
        // Example: use policies here
        // $this->authorize($ability, $model ?? ForumThread::class);
    }

    protected function redirectAfterStore(Model $model)
    {
        return redirect()
            ->route('categories.show', $model->category)
            ->with('success', 'Thread created successfully.');
    }

    protected function redirectAfterUpdate(Model $model)
    {
        return redirect()->route('threads.show', $model)
            ->with('success', 'Thread updated successfully.');
    }

    protected function redirectAfterDelete()
    {
        return redirect()->route('dashboard')
            ->with('success', 'Thread deleted successfully.');
    }

    /* =========================================================
     | OPTIONAL HOOKS
     |=========================================================*/

    protected function afterDelete(Model $model): void
    {
        // Example: Delete all posts in this thread before deleting the thread
        $model->posts()->delete();
    }
}
