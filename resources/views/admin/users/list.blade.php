@extends('layouts.admin')
@section('title', 'List')
@section('content')
    <h1 class="h3 mb-0 text-gray-800 mb-4">User List</h1>
    @if (session('msg'))
        <div class="alert alert-success text-center">{{ session('msg') }}</div>
    @endif
    @can('users.add')
        <p><a class="btn btn-info" href="{{ route('admin.users.add') }}">Add new</a></p>
    @endcan
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td>ID.</td>
                <td>Name</td>
                <td>Email</td>
                <td>Group</td>
                @can('users.edit')
                    <td width="5%">Edit</td>
                @endcan

                @can('users.remove')
                    <td width="5%">Delete</td>
                @endcan

            </tr>
        </thead>
        <tbody>
            @if ($users->count() > 0)
                @foreach ($users as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->group->name }}</td>
                        @can('users.edit')
                            <td><a href="{{ route('admin.users.edit', $item) }}" class="btn btn-warning">edit</a></td>
                        @endcan
                        @can('users.remove')
                            <td>
                                @if (Auth::user()->id != $item->id)
                                    <a onclick="confirm('Are you sure to delete this User?')"
                                        href="{{ route('admin.users.delete', $item) }}" class="btn btn-danger">delete</a>
                                @endif
                            </td>
                        @endcan
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
