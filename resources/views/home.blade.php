<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- HOME CONTENT --}}
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h1>Welcome</h1>
            <p class="text-muted">Testing dynamic navbar & pages</p>
        </div>

        <div class="row">
            @foreach($navigations as $nav)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $nav->title }}</h5>

                        @if($nav->short_content)
                        <p class="card-text">{{ $nav->short_content }}</p>
                        @endif

                        <a href="{{ url($nav->slug) }}" class="btn btn-primary btn-sm">
                            Open Page
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>