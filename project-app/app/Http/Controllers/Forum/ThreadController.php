<?php

namespace App\Http\Controllers\Forum;

use App\Models\ForumThread;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ThreadController extends AbstractCrudController
{
    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);
    }

    protected function createModel(array $data): Model
    {
        return ForumThread::create([
            ...$data,
            'author_id' => auth()->id(),
        ]);
    }

    protected function authorizeAction(string $ability, ?Model $model = null): void
    {
        $this->authorize($ability, $model ?? ForumThread::class);
    }

    protected function redirectAfterStore(Model $model)
    {
        return redirect()->route('threads.show', $model);
    }

    protected function redirectAfterUpdate(Model $model)
    {
        return redirect()->route('threads.show', $model);
    }

    protected function redirectAfterDelete()
    {
        return redirect()->route('categories.index');
    }
}
