@extends('layouts.master')

@section('content')
    <header class="page-header">
        <h1>Manage Posts</h1>
    </header>

    <section ng-app="blogModule">
        <table class="table table-striped" ng-controller="ManageController">
            <tr><th>Title</th><th>Author</th><th>Posted</th><th>&nbsp;</th></tr>

            <tr ng-repeat="post in posts">
                <td><a ng-href="/posts/@{{ post.id }}">@{{ post.title }}</a></td>
                <td>@{{ post.user.first_name }} @{{ post.user.last_name }}</td>
                <td>@{{ post.created_at.date }}</td>
                <td><button class="btn btn-danger btn-xs" ng-click="deletePost($index)">Delete</button></td>
            </tr>
        </table>
    </section>
@stop

@section('script')
    <script src="/js/angular.min.js"></script>
    <script src="/js/blogModule.js"></script>
@stop
