@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $page->title }}</h1>
    @if($children->count())
    <div class="list-group">
        @foreach($children as $item)
        <a href="{{ url($item->slug) }}" class="list-group-item list-group-item-action">
            {{ $item->title }}
        </a>
        @endforeach
    </div>
    @else
    <div>{!! $page->main_content !!}</div>
    @endif
</div>
@endsection