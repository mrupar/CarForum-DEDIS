@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create New Category</h3>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Category Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Description</label>
            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>
@endsection
