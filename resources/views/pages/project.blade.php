@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container py-5">
    <h1>{{ $page->title }}</h1>
    <div>{!! $page->main_content !!}</div>

    @if($children->count())
    <div class="row mt-4">
        @foreach($children as $project)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5>{{ $project->title }}</h5>
                    <p>{{ $project->short_content }}</p>
                    <a href="{{ url($project->slug) }}" class="btn btn-sm btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection