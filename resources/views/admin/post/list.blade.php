@extends('layouts.admin')
@section('title', 'List')
@section('content')
    <h1 class="h3 mb-0 text-gray-800 mb-4">Post List</h1>
    @if (session('msg'))
        <div class="alert alert-success text-center">{{ session('msg') }}</div>
    @endif
    @can('posts.add')
        <p><a class="btn btn-primary" href="{{ route('admin.posts.add') }}">New Post</a></p>
    @endcan
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td width="3%">ID.</td>
                <td>Title</td>
                <td>Content</td>
                <td width="10%">Post By</td>
                @can('posts.edit')
                    <td width="5%">Edit</td>
                @endcan
                @can('posts.remove')
                    <td width="5%">Delete</td>
                @endcan

            </tr>
        </thead>
        <tbody>
            @if ($posts->count() > 0)
                @foreach ($posts as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->content }}</td>
                        <td>{{ !empty($item->postBy->name) ? $item->postBy->name : false }}</td>
                        @can('posts.edit')
                            <td><a href="{{ route('admin.posts.update', $item) }}" class="btn btn-warning">update</a></td>
                        @endcan
                        @can('posts.remove')
                            <td>
                                <a onclick="confirm('Are you sure to delete this User?')"
                                    href="{{ route('admin.posts.delete', $item) }}" class="btn btn-danger">delete</a>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
