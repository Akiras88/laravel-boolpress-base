@extends('layouts.main')

@section('content')
    <h1>Blog archive</h1>
    @foreach ( $users as $user )
        <div class="user">
            <h2>{{ $user->name }}</h2>
            <h5>{{ $user->email }}</h5>
            <img src="{{ $user->info['avatar'] }}" alt="{{ $user->name }}">
            <div> {{ $user->info['address'] }} </div>
            <div> {{ $user->info['phone'] }} </div>
            <h3>Posts</h3>
            <ul>
                @foreach( $user->posts as $post )
                    <li>
                        <h4>{{ $post->title }}</h4>
                        <p>{{ $post->body }}</p>
                        <h3>Comments:</h3>
                        @foreach( $post->comments as $comment )
                            <h4>{{ $comment->title }}</h4>
                            <p>{{ $comment->body }}</p>
                            <a href="{{ route('infocomments.index') }}">{{ $comment->name }}</a>
                        @endforeach
                    </li>
                @endforeach
            </ul>
        </div>
        @if ( ! $loop->last )
            <hr>
        @endif
    @endforeach
@endsection