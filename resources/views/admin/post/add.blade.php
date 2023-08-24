@extends('layouts.admin')
@section('title', 'Add')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger text-center">Please check all of your input data</div>
    @endif
    <form action="" method="POST">

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter title..." name="title" value="{{ old('title') }}">
            <span class="input-group-text">Post title</span>
        </div>
        <div class="mb-3">
            @error('title')
                <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="input-group mb-3">
            <textarea class="form-control" placeholder="....." name="content" value="{{ old('content') }}" rows="10"></textarea>
            <span class="input-group-text">Post content</span>
        </div>
        <div class="mb-3">
            @error('content')
                <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">New Post</button>
        @csrf
    </form>
@endsection
