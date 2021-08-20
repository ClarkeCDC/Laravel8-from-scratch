@extends('layout')

@section('content')
    <article>
        <h1>{{$post->title}}</h1>
        <div>
            {!! $post->body !!}
        </div>
    </article>
    <a href="/posts">Go back</a>
@endsection
