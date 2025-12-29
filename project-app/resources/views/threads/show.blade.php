@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $thread->title }}</h3>
    <p>by {{ $thread->author->name }}</p>
    <div class="mb-4">{{ $thread->content }}</div>

    <h5>Posts</h5>

    @forelse($thread->posts as $post)
        <div class="card mb-2">
            <div class="card-body">
                <p>{{ $post->content }}</p>
                <small class="text-muted">by {{ $post->author->name }}</small>
            </div>
        </div>
    @empty
        <p>No posts yet.</p>
    @endforelse

    @auth
    <div class="mt-4">
        <h5>Add a Post</h5>
        <form method="POST" action="{{ route('posts.store', $thread) }}">
            @csrf
            <div class="mb-3">
                <textarea class="form-control" name="content" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Post</button>
        </form>
    </div>
    @endauth
</div>
@endsection
