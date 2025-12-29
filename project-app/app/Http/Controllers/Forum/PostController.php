<?php

namespace App\Http\Controllers\Forum;

use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class PostController extends AbstractCrudController
{
    protected function validateRequest(Request $request): array
    {
        return $request->validate([
            'body' => 'required|string',
            'thread_id' => 'required|exists:threads,id',
        ]);
    }

    protected function createModel(array $data): Model
    {
        return ForumPost::create([
            ...$data,
            'author_id' => auth()->id(),
        ]);
    }

    protected function authorizeAction(string $ability, ?Model $model = null): void
    {
        $this->authorize($ability, $model ?? ForumPost::class);
    }

    protected function afterCreate(Model $model): void
    {
        $model->thread->touch(); // update thread timestamp
    }

    protected function redirectAfterStore(Model $model)
    {
        return redirect()->route('threads.show', $model->thread_id);
    }

    protected function redirectAfterUpdate(Model $model)
    {
        return redirect()->route('threads.show', $model->thread_id);
    }

    protected function redirectAfterDelete()
    {
        return back();
    }
}
