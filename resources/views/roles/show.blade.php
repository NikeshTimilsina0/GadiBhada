@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Role Details</h3>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary float-right">Back</a>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $role->name }}</p>
        <p><strong>Permissions:</strong></p>
        <div>
            @foreach($role->permissions as $permission)
                <span class="badge badge-info">{{ $permission->name }}</span>
            @endforeach
        </div>
    </div>
</div>
@endsection
