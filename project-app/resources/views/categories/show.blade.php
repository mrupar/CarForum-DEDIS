@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Category: {{ $category->title }}</h3>
    <p>{{ $category->content }}</p>

    <h5 class="mt-4">Threads</h5>

    <div class="list-group">
        @forelse($threads as $thread)
            <a href="{{ route('threads.show', $thread) }}" class="list-group-item list-group-item-action">
                {{ $thread->title }} 
                <small class="text-muted">by {{ $thread->author->name }} | {{ $thread->posts_count }} posts</small>
            </a>
        @empty
            <p>No threads in this category yet.</p>
        @endforelse
    </div>
</div>
@endsection
