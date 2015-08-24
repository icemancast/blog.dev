@extends('layouts.master')

@section('content')

    <h2>{{ $post->title }}</h2>

    <p>{{ $post->body }}</p>

    @if(Session::has('test'))
        {{ Session::get('test') }}
    @endif

    <div class="row">
        <div class="col-md-6">
            <a class="btn btn-primary" href="{{ action('PostsController@edit', $post->id) }}">Edit</a>
            <button id="delete" class="btn btn-danger">Delete</button>
        </div>
    </div>

    {{ Form::open(array('action' => array('PostsController@destroy', $post->id), 'method' => 'DELETE', 'id' => 'formDelete')) }}
    {{ Form::close() }}

@stop

@section('script')
    <script>
        
        (function(){

            "use strict";

            $('#delete').on('click', function(){

                var onConfirm = confirm('Are you sure you want to. There is no turning back!');

                if(onConfirm) {
                    $('#formDelete').submit();
                }

            });

        })();

    </script>
@stop