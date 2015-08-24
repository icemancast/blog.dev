@extends('layouts.master')

@section('content')
    
    {{ $posts->links() }}

    <h2>Blog Posts</h2>

    @foreach($posts as $post)
        <h2><a href="{{ action('PostsController@show', $post->id) }}">{{ $post->title }}</a></h2>
        {{ $post->body }}
    @endforeach
@stop