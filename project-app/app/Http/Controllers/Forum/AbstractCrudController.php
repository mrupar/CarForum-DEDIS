<?php

namespace App\Http\Controllers\Forum;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

abstract class AbstractCrudController extends Controller
{
    /** Template method */
    public function store(Request $request)
    {
        $this->authorizeAction('create');

        $validated = $this->validateRequest($request);

        $model = $this->createModel($validated);

        $this->afterCreate($model);

        return $this->redirectAfterStore($model);
    }

    /** Template method */
    public function update(Request $request, Model $model)
    {
        $this->authorizeAction('update', $model);

        $validated = $this->validateRequest($request);

        $model->update($validated);

        $this->afterUpdate($model);

        return $this->redirectAfterUpdate($model);
    }

    public function destroy(Model $model)
    {
        $this->authorizeAction('delete', $model);

        $model->delete();

        $this->afterDelete($model);

        return $this->redirectAfterDelete();
    }

    /* ===== Hooks ===== */

    abstract protected function validateRequest(Request $request): array;

    abstract protected function createModel(array $data): Model;

    abstract protected function authorizeAction(string $ability, ?Model $model = null): void;

    /* ===== Optional Hooks ===== */

    protected function afterCreate(Model $model): void {}
    protected function afterUpdate(Model $model): void {}
    protected function afterDelete(Model $model): void {}

    abstract protected function redirectAfterStore(Model $model);
    abstract protected function redirectAfterUpdate(Model $model);
    abstract protected function redirectAfterDelete();
}
