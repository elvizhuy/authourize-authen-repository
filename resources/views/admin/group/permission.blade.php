@extends('layouts.admin')
@section('title', 'Permission ' . $group->name)
@section('content')
    <h1 class="h3 mb-0 text-gray-800 mb-4">Permission Group: {{ $group->name }}</h1>
    @if (session('msg'))
        <div class="alert alert-success text-center">{{ session('msg') }}</div>
    @endif

    <form action="" method="POST">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td width="20%">Module</td>
                    <td>Permission</td>
                </tr>
            </thead>
            <tbody>
               
                @if ($modules->count() > 0)
                    @foreach ($modules as $module)
                        <tr>
                            <td>{{ $module->title }}</td>
                            <td>
                                <div class="row">
                                    @if (!@empty($roleListArr))
                                        @foreach ($roleListArr as $roleName => $roleLabel)
                                            <div class="col-2">
                                                <input type="checkbox" class="form-check-input me-2"
                                                    name="role[{{ $module->name }}][]"
                                                    id="role_{{ $module->name }}_{{ $roleName }}"
                                                    value="{{ $roleName }}"
                                                    {{ isRole($roleArr, $module->name, $roleName) ? 'checked' : false }}>
                                                <label
                                                    for="role_{{ $module->name }}_{{ $roleName }}">{{ $roleLabel }}</label>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($module->name == 'groups')
                                        <div class="col-2">
                                            <input type="checkbox" class="form-check-input"
                                                name="role[{{ $module->name }}][]"
                                                id="role_{{ $module->name }}_permission" value="permission"
                                                {{ isRole($roleArr, $module->name, 'permission') ? 'checked' : false }}>
                                            <label for="role_{{ $module->name }}_permission">Grant Permission</label>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <button type="submit" class="btn btn-dark">Grant Permission</button>
        @csrf
    </form>
@endsection
