@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- ================= HERO SLIDER ================= --}}
<section class="py-5 bg-dark text-white">
    <div class="container-lg">
        <div class="row align-items-center">
            <div class="col-md-7">
                <span class="text-uppercase text-warning fw-bold small">Producing What Matters</span>
                <h1 class="display-4 fw-bold mt-2"> Welcome to<br>CMSPractice
                </h1>
                <p class="lead mt-3 text-white-50"> Template to create a good website. Use this layout to showcase your
                    value proposition clearly and efficiently.
                </p>
                <div class="mt-4">
                    <a href="#" class="btn btn-primary btn-lg me-2 px-4 shadow">Learn More</a>
                    <a href="#" class="btn btn-outline-light btn-lg px-4">Call Us: 01-1234567</a>
                </div>
            </div>

            <div class="col-md-5">
                <img src="https://images.unsplash.com/photo-1509395176047-4a66953fd231"
                    class="img-fluid rounded-4 shadow-lg d-block ms-auto w-75 mt-5 mt-md-0"
                    alt="Hydropower">
            </div>
        </div>
    </div>
</section>

{{-- ================= ABOUT SECTION ================= --}}
<section class="py-5 bg-light">
    <div class="container-lg">
        <div class="row align-items-center g-lg-5">

            <div class="col-md-7">
                <span class="text-uppercase text-primary fw-bold">About Us</span>
                <h2 class="display-5 fw-bold mt-2">Welcome to Demo Hydropower Limited</h2>
                <p class="lead mt-3 text-dark">
                    Demo Hydropower Limited is dedicated to harnessing water
                    resources efficiently to produce clean and reliable electricity.
                </p>
                <p class="text-muted mb-4">
                    Our mission is to contribute to national energy security while
                    maintaining environmental responsibility.
                </p>
                <a href="#" class="btn btn-primary btn-lg px-4 shadow-sm">
                    How We Generate Energy
                </a>
            </div>

            <div class="col-md-5">
                <img src="https://images.unsplash.com/photo-1527482797697-8795b05a13fe"
                    class="img-fluid rounded-4 shadow-lg d-block ms-auto w-75"
                    alt="About Image">
            </div>

        </div>
    </div>
</section>

{{-- ================= PROJECT UPDATES ================= --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Project Updates</h2>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img
                        src="https://images.unsplash.com/photo-1508873699372-7aeab60b44b9"
                        class="card-img-top"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">
                            Upper River Hydropower Project (4MW)
                        </h5>
                        <p class="card-text">
                            A run-of-river hydropower project currently in operation.
                        </p>
                        <a href="#" class="btn btn-sm btn-primary">Read More</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img
                        src="https://images.unsplash.com/photo-1469474968028-56623f02e42e"
                        class="card-img-top"
                        alt="">
                    <div class="card-body">
                        <h5 class="card-title">
                            Valley Stream Hydropower Project (2MW)
                        </h5>
                        <p class="card-text">
                            Efficient small-scale hydropower for local communities.
                        </p>
                        <a href="#" class="btn btn-sm btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= NEWS SECTION ================= --}}
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="fw-bold">News</h2>
                <p class="mt-3">
                    Stay updated with the latest announcements, reports, and
                    company activities.
                </p>
                <a href="#" class="btn btn-outline-light mt-3">Read All News</a>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img
                                src="https://images.unsplash.com/photo-1581092580497-e0d23cbdf1dc"
                                class="card-img-top"
                                alt="">
                            <div class="card-body">
                                <h5 class="card-title">Annual General Meeting 2081</h5>
                                <a href="#" class="btn btn-sm btn-primary">Full Story</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <img
                                src="https://images.unsplash.com/photo-1520607162513-77705c0f0d4a"
                                class="card-img-top"
                                alt="">
                            <div class="card-body">
                                <h5 class="card-title">Prospectus for Right Share</h5>
                                <a href="#" class="btn btn-sm btn-primary">Full Story</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= TESTIMONIALS ================= --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Testimonials</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm p-4 text-center">
                    <p class="fst-italic">
                        “Hydropower provides clean energy while protecting
                        the environment for future generations.”
                    </p>
                    <img
                        src="https://randomuser.me/api/portraits/men/32.jpg"
                        class="rounded-circle mx-auto my-3"
                        width="80"
                        alt="">
                    <h5 class="mb-0">John Doe</h5>
                    <small class="text-muted">Energy Consultant</small>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================= PARTNERS ================= --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Our Partners</h2>
        <div class="row justify-content-center">
            <div class="col-md-2 col-4 mb-3">
                <img src="https://dummyimage.com/150x80/000/fff&text=Partner+1" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-3">
                <img src="https://dummyimage.com/150x80/000/fff&text=Partner+2" class="img-fluid">
            </div>
            <div class="col-md-2 col-4 mb-3">
                <img src="https://dummyimage.com/150x80/000/fff&text=Partner+3" class="img-fluid">
            </div>
        </div>
    </div>
</section>

@endsection