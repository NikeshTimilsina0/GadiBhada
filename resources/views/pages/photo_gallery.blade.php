@extends('layouts.app')

@section('title', $page->title)

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $page->title }}</h1>
    <div class="row">
        @foreach($children as $photo)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ $photo->main_content }}" alt="{{ $photo->title }}" class="img-fluid">
                <div class="card-body">
                    <h6>{{ $photo->title }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection