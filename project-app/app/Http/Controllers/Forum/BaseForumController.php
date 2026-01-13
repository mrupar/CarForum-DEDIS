<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

abstract class BaseForumController extends Controller
{
    /** Template method */
    public function store(Request $request, $context = null)
    {
        $this->authorizeAction('create');

        $validated = $this->validateRequest($request);

        $model = $this->createModel($validated, $context);

        return $this->redirectAfterStore($model);
    }

    /** Template method */
    public function update(Request $request, Model $model)
    {
        $this->authorizeAction('update', $model);

        $validated = $this->validateRequest($request);

        $model->update($validated);

        return $this->redirectAfterUpdate($model);
    }

    public function destroy(Model $model)
    {
        $this->authorizeAction('delete', $model);

        $model->delete();

        return $this->redirectAfterDelete();
    }

    /* ===== Hooks ===== */

    abstract protected function validateRequest(Request $request): array;

    abstract protected function createModel(array $data, $context = null): Model;

    abstract protected function authorizeAction(string $ability, ?Model $model = null): void;

    abstract protected function redirectAfterStore(Model $model);
    abstract protected function redirectAfterUpdate(Model $model);
    abstract protected function redirectAfterDelete();
}
