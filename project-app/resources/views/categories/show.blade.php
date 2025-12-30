@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Category: {{ $category->title }}</h3>

        @auth
        <div>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>

            <form method="POST" action="{{ route('categories.destroy', $category) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        @endauth
    </div>

    <p>{{ $category->content }}</p>

    <h5 class="mt-4">Threads</h5>

    @auth
    <div class="mb-3">
        <a href="{{ route('threads.create', $category) }}" class="btn btn-primary">+ Create New Thread</a>
    </div>
    @endauth

    <div class="list-group">
        @forelse($threads as $thread)
            <a href="{{ route('threads.show', $thread) }}" class="list-group-item list-group-item-action">
                {{ $thread->title }}
                <small class="text-muted">
                    by {{ $thread->author->name }} | {{ $thread->posts_count }} posts
                </small>
            </a>
        @empty
            <p>No threads in this category yet.</p>
        @endforelse
    </div>
</div>
@endsection
