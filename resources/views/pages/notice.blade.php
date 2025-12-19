@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container py-5">
    <h1>{{ $page->title }}</h1>
    <div>{!! $page->main_content !!}</div>

    @if($children->count())
    <ul>
        @foreach($children as $child)
        <li><a href="{{ url($child->slug) }}">{{ $child->title }}</a></li>
        @endforeach
    </ul>
    @endif
</div>
@endsection