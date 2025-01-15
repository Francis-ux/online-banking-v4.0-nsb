@extends('layouts.master')
@section('content')
    <!-- page-title -->
    <section class="page-title centred">
        <div class="bg-layer" style="background-image: url(/assets/images/background/page-title.jpg);"></div>
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(/assets/images/shape/shape-18.png);"></div>
            <div class="pattern-2" style="background-image: url(/assets/images/shape/shape-17.png);"></div>
        </div>
        <div class="auto-container">
            <div class="content-box">
                <h1>{{ $title }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->

    <!-- service-section -->
    @include('layouts.sections.service')
    <!-- service-section end -->

    <!-- testimonial-style-two -->
    @include('layouts.sections.testimonial')
    <!-- testimonial-style-two end -->
@endsection
