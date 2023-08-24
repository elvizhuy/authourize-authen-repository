@extends('layouts.admin')
@section('title', 'List')
@section('content')
    <h1 class="h3 mb-0 text-gray-800 mb-4">Group List</h1>
    @if (session('msg'))
        <div class="alert alert-success text-center">{{ session('msg') }}</div>
    @endif
    @can('groups.add')
        <p><a class="btn btn-primary" href="{{ route('admin.groups.add') }}">Store</a></p>
    @endcan
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td width="3%">ID.</td>
                <td>Name</td>
                <td>Post By</td>
                @can('groups.permission')
                <td width="15%">Permission</td>
                 @endcan
                @can('groups.edit')
                <td width="5%">Edit</td>
                @endcan
                @can('groups.remove')
                <td width="5%">Delete</td>
                @endcan
            </tr>
        </thead>
        <tbody>
            @if ($groups->count() > 0)
                @foreach ($groups as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ !empty($item->postBy->name) ? $item->postBy->name : false }}</td>
                        @can('groups.permission')
                            <td><a class="btn btn-secondary" href="{{ route('admin.groups.permission', $item) }}">Grant
                                    Permission</a></td>
                        @endcan

                        @can('groups.edit')
                            <td><a href="{{ route('admin.groups.edit', $item) }}" class="btn btn-warning">edit</a></td>
                        @endcan

                        @can('groups.remove')
                            <td>
                                <a onclick="confirm('Are you sure to delete this User?')"
                                    href="{{ route('admin.groups.delete', $item) }}" class="btn btn-danger">delete</a>
                            </td>
                        @endcan

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
