@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $page->title }}</h1>
    <div>{!! $page->main_content !!}</div>

    @if($children->count())
    <div class="mt-5">
        <h3>Sub Pages</h3>
        <ul>
            @foreach($children as $child)
            <li><a href="{{ url($child->slug) }}">{{ $child->title }}</a></li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection