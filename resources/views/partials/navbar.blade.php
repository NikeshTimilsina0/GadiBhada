<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            CMSPractice
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ url('/') }}">Home</a>

                @foreach($navigations as $nav)
                @if($nav->children->count() > 0)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ $nav->title }}
                    </a>

                    <ul class="dropdown-menu">
                        @foreach($nav->children as $child)
                        <li>
                            <a class="dropdown-item" href="{{ url($child->slug) }}">
                                {{ $child->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url($nav->slug) }}">
                        {{ $nav->title }}
                    </a>
                </li>
                @endif
                @endforeach

            </ul>
        </div>
    </div>
</nav>