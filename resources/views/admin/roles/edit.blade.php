@extends('admin.layouts.master')

@section('content')
<div class="card shadow p-4 rounded-4 mt-3 bg-light">
    <div class="card-header">
        <h3 class="card-title">Edit Role - {{ $role->name }}</h3>
    </div>

    {{-- Display validation errors --}}
    @if($errors->any())
    <div class="alert alert-danger m-3">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group mb-3">
                <label for="name">Role Name</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name', $role->name) }}" required>
            </div>

            <div class="form-group">
                <label>Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox" name="permissions[]"
                                value="{{ $permission->id }}" class="form-check-input"
                                {{ (in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()))) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection