@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $page->title }}</h1>
    <div class="row">
        @foreach($children as $video)
        <div class="col-md-4 mb-4">
            <div class="card">
                {!! $video->main_content !!}
                <div class="card-body">
                    <h6>{{ $video->title }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection