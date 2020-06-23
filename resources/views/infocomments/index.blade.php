@extends('layouts.main')

@section('content')
    @foreach ( $comment->InfoComments as $InfoComment )
        <h3>{{ $InfoComment->phone }}</h3>
        <h3>{{ $InfoComment->address }}</h3>
        <img src="{{ $InfoComment->avatar }}" alt="">
    @endforeach 
@endsection