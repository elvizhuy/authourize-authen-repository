@extends('layouts.admin')
@section('title', 'Add')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger text-center">Please check all of your input data</div>
    @endif
    <form action="" method="POST">

        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Enter name..." name="name" value="{{ old('name') }}">
            <span class="input-group-text">Group Name</span>
        </div>
        <div class="mb-3">
            @error('name')
                <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Store</button>
        @csrf
    </form>
@endsection
