@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Create Thread in: {{ $category->title }}</h3>

    <form method="POST" action="{{ route('threads.store', $category) }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Thread Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Thread</button>
    </form>
</div>
@endsection
