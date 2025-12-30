@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Thread</h3>

    <form action="{{ route('threads.update', $thread) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control"
                   value="{{ old('title', $thread->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" rows="5" class="form-control">{{ old('content', $thread->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Thread</button>
        <a href="{{ route('threads.show', $thread) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
