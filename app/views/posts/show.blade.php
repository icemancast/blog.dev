@extends('layouts.master')

@section('content')
    <header class="page-header">
        <h1>{{{ $post->title }}}</h1>
        <small class="text-muted">
            {{{ $post->created_at->format('F jS, Y g:i a') }}}
            by {{{ $post->user->first_name }}} {{{ $post->user->last_name }}}
        </small>
    </header>

    <p>{{{ $post->body }}}</p>

    @if (Auth::check())
        <footer>
            <a class="btn btn-default" href="{{ action('PostsController@edit', $post->id) }}">Edit</a>
            <button id="delete" class="btn btn-danger">Delete</button>
        </footer>
    @endif

    {{ Form::open(array('action' => array('PostsController@destroy', $post->id), 'method' => 'DELETE', 'id' => 'formDelete')) }}
    {{ Form::close() }}
@stop

@section('script')
    <script>
        (function(){
            "use strict";

            $('#delete').on('click', function(){
                if(confirm('Are you sure you want to do this? There is no turning back!')) {
                    $('#formDelete').submit();
                }
            });
        })();
    </script>
@stop
