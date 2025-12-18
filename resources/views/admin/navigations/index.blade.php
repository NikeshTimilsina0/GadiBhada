@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card shadow p-3 rounded-4 mt-3">
        <div class="card-header">
            <h3 class="card-title">Navigation List</h3>
        </div>
        <div class="card-body">
            @if($navigations->count() > 0)
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Page Type</th>
                        <th>Children</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($navigations as $nav)
                    <tr>
                        <td>{{ $nav->title }}</td>

                        <td>
                            {{ $nav->pageType?->title ?? '-' }}
                        </td>

                        <td>
                            @if($nav->children_count > 0)
                            <span class="badge bg-info">
                                {{ $nav->children_count }}
                            </span>
                            @else
                            <span class="badge bg-danger"> 0 </span>
                            @endif
                        </td>

                        <td>
                            {{-- OPEN --}}
                            @if($nav->children_count > 0)
                            <a href="{{ route('admin.navigations.index', ['parent' => $nav->id]) }}"
                                class="btn btn-sm btn-primary">
                                Open
                            </a>
                            @endif

                            {{-- EDIT --}}
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>

                            {{-- DELETE --}}
                            @if($nav->children_count == 0)
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
            <p>No navigations found.</p>
            @endif
        </div>
    </div>
</div>
@endsection