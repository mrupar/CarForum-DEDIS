@extends('layouts.app')

@section('content')
<h3 class="mb-4">Forum Categories</h3>

@auth
<div class="mb-3">
    <a href="{{ route('categories.create') }}" class="btn btn-success">+ Create New Category</a>
</div>
@endauth

<div class="row">
    @forelse($categories as $category)
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('categories.show', $category) }}">
                            {{ $category->title }}
                        </a>
                    </h5>
                    <p class="card-text">{{ $category->content }}</p>
                </div>
                <div class="card-footer text-muted">
                    Threads: {{ $category->threads_count }}
                </div>
            </div>
        </div>
    @empty
        <p>No categories found.</p>
    @endforelse
</div>
@endsection
