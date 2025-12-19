@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $page->title }}</h1>

    {{-- Main content of News page --}}
    <div class="mb-5">
        {!! $page->content !!}
    </div>

    {{-- Children News as Cards --}}
    @if($children && $children->count() > 0)
    <h3 class="mb-4">Sub Pages</h3>
    <div class="row">
        @foreach($children as $child)
        <div class="col-md-4 mb-4">
            <div class="card shadow p-3 rounded-4 h-100">
                <div class="card-body d-flex flex-column">
                    {{-- Child Title --}}
                    <h5 class="card-title">{{ $child->title }}</h5>

                    {{-- Short Content --}}
                    <p class="card-text">
                        {!! Str::limit(strip_tags($child->content), 150, '...') !!}
                    </p>

                    {{-- Read More Button --}}
                    <a href="{{ route('pages.show', $child->slug) }}" class="btn btn-primary mt-auto">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>No news available at the moment.</p>
    @endif
</div>
@endsection