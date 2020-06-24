@extends('layouts.main')

@section('content')

    @if (session('post-deleted'))
        <div class="alert alert-success">
            <p>The following post been deleted successfully:</p>
            {{ session('post-deleted') }}
        </div>
    @endif

    <h1 class="mb-4">Blog archive</h1>
    @foreach ( $posts as $post )
        <article>
            <h2>{{ $post->title }}</h2>
            <h4 class="author">{{ $post->user->name }}</h4>
            <h4>Created: {{ $post->created_at }}, last modified: {{ $post->updated_at }}</h4>
            <p>{{ $post->body }}</p>
            <a href="{{ route('posts.show', $post->slug) }}">Read more</a>
        </article>
        @if( ! $loop->last )
            <hr>
        @endif
    @endforeach

    <div class="wrap-pagination mt-5 d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
@endsection