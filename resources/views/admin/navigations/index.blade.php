@extends('admin.layouts.master')

@section('content')

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0 d-inline">Navigation Management</h1>
            </div>
            <div class="col-sm-6 text-end">
                @if(isset($parent))
                <a href="{{ route('admin.navigations.index') }}" class="btn btn-secondary float-right" style="margin-right: 20px;">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                @endif
            </div>
        </div>
    </div>
</div>




<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">

                    {{-- CARD HEADER --}}
                    <div class="card-header">
                        <h3 class="card-title">Navigation List</h3>

                        <a href="{{ route('admin.navigations.create') }}"
                            class="btn btn-primary float-right">
                            Create Navigation
                        </a>
                    </div>

                    {{-- CARD BODY --}}
                    <div class="card-body">

                        @if($navigations->count())
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="60">#</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Page Type</th>
                                    @if(!isset($parent))
                                    <th width="100">Children</th>
                                    @endif
                                    <th width="240">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($navigations as $nav)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $nav->title }}</td>
                                    <td>{{ $nav->slug }}</td>

                                    <td>
                                        @if($nav->pageType)
                                        <span class="badge badge-info">{{ $nav->pageType->title }}</span>
                                        @else
                                        <span class="text-muted">—</span>
                                        @endif
                                    </td>


                                    @if (!isset($parent))

                                    <td>
                                        @if($nav->children_count > 0)
                                        <span class="badge badge-success">{{ $nav->children_count }}</span>
                                        @else
                                        <span class="badge badge-danger">0</span>
                                        @endif
                                    </td>
                                    @endif


                                    <td>
                                        <div class="d-flex gap-1">
                                            {{-- OPEN --}}
                                            @if($nav->children_count > 0)
                                            <a href="{{ route('admin.navigations.index', ['parent' => $nav->id]) }}"
                                                class="btn btn-sm btn-secondary btn-action">
                                                Open
                                            </a>
                                            @endif

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.navigations.edit', $nav) }}"
                                                class="btn btn-sm btn-info btn-action">
                                                Edit
                                            </a>

                                            {{-- DELETE --}}
                                            @if($nav->children_count == 0)
                                            <form action="{{ route('admin.navigations.destroy', $nav) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this navigation?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger btn-action">Delete</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        @else
                        <p class="text-muted mb-0">No navigations found.</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- Add this CSS to ensure uniform button sizes --}}
@push('styles')
<style>
    .btn-action {
        min-width: 60px;
        text-align: center;
        margin-right: 3px;
    }
</style>
@endpush

@endsection