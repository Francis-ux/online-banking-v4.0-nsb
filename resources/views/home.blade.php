@extends('layouts.master')
@section('content')
    <!-- banner-section -->
    @include('layouts.sections.banner')
    <!-- banner-section end -->

    <!-- feature-section -->
    @include('layouts.sections.feature_section')<!-- feature-section end -->

    <!-- about-section -->
    @include('layouts.sections.about') <!-- about-section end -->

    <!-- service-section -->
    @include('layouts.sections.service') <!-- service-section end -->

    <!-- calculator-section -->
    @include('layouts.sections.calculator') <!-- calculator-section end -->

    <!-- testimonial-section -->
    @include('layouts.sections.testimonial') <!-- testimonial-section end -->
@endsection
