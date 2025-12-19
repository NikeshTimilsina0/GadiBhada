@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $page->title }}</h1>

    @if($page->short_content)
    <p class="lead text-muted">{{ $page->short_content }}</p>
    @endif

    @if($page->main_content)
    <div class="mb-4">
        {!! $page->main_content !!}
    </div>
    @endif

    {{-- If this page has child pages, show them as cards --}}
    @if($children->count())
    <div class="row">
        @foreach($children as $child)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($child->image)
                <img src="{{ $child->image }}" class="card-img-top" alt="{{ $child->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $child->title }}</h5>
                    <p class="card-text">{{ $child->short_content }}</p>
                    <a href="{{ route('pages.show', $child->slug) }}" class="btn btn-sm btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection