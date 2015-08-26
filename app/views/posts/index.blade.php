@extends('layouts.master')

@section('content')
    <header class="page-header">
        <h1>Blog Posts</h1>
    </header>

    @foreach($posts as $post)
        <article>
            <header>
                <h2><a href="{{ action('PostsController@show', $post->id) }}">{{ $post->title }}</a></h2>

                <small class="text-muted">
                    {{{ $post->created_at->diffForHumans() }}}
                    by {{ $post->user->first_name }} {{ $post->user->last_name }}
                </small>
            </header>

            <p>{{{ Str::words($post->body, 20) }}}</p>
        </article>
    @endforeach

    <footer>
        {{ $posts->links() }}
    </footer>
@stop
