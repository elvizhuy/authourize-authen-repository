@extends('layouts.admin')
@section('title', 'Edit')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger text-center">Please check all of your input data</div>
    @endif
    @if (session('msg'))
    <div class="alert alert-success text-center">{{session('msg')}}</div>
    @endif
            <form action="" method="POST">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter name..." name="name"
                        value="{{ old('name') ?? $user->name }}">
                    <span class="input-group-text">Full Name</span>
                </div>
                <div class="mb-3">
                    @error('name')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>


                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Enter email..." name="email"
                        value="{{ old('name') ?? $user->email }}">
                    <span class="input-group-text">Email</span>
                </div>
                <div class="mb-3">
                    @error('email')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>


                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Enter password..." name="password">
                    <span class="input-group-text">Password</span>
                </div>
                <div class="mb-3">
                    @error('password')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>


                <div class="input-group mb-3">
                    <label class="input-group-text" for="">Group</label>
                    <select class="form-select" name="groups_id">
                        <option value="0">Choose group</option>
                        @if ($groups->count() > 0)
                            @foreach ($groups as $item)
                                <option value="{{ $item->id }}"
                                    {{ $user->groups_id == $item->id || old('groups_id') == $item->id ? 'selected' : false }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    @error('groups_id')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark">Update</button>
                @csrf
            </form>

@endsection
