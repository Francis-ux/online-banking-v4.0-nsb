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
                <h1>{{ config('app.name') }}</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="/">Home</a></li>
                    <li>{{ $title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->

    <!-- contact-info-section -->
    <section class="contact-info-section centred pt_120 pb_90">
        <div class="auto-container">
            <div class="sec-title mb_70">
                <h2>{{ config('app.name') }}</h2>
            </div>
            <div class="row clearfix">
                @if (config('app.address'))
                    <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                        <div class="info-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-2"></i></div>
                                <h3>Our Location</h3>
                                <p>{{ config('app.address') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                    <div class="info-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-43"></i></div>
                            <h3>Email Address</h3>
                            <p>{{ config('app.email') }}</p>
                        </div>
                    </div>
                </div>
                @if (config('app.phone'))
                    <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                        <div class="info-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="icon-box"><i class="icon-44"></i></div>
                                <h3>Phone Number</h3>
                                <p>{{ config('app.phone') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- contact-info-section end -->

    <!-- contact-section -->
    <section class="contact-section pt_120 pb_120">
        <div class="auto-container">
            <div class="sec-title centred mb_70">
                <h2>{{ $title }}</h2>
            </div>
            <div class="form-inner">
                @include('partials.validation_message')
                @include('partials.sweet_alert')
                <form action="{{ route('contact.store') }}" method="post">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="name" placeholder="Your Name" required
                                value="{{ old('name') }}">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="email" name="email" placeholder="Your email" required
                                value="{{ old('email') }}">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="phone" required placeholder="Phone" value="{{ old('phone') }}">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                            <input type="text" name="subject" required placeholder="Subject"
                                value="{{ old('subject') }}">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                            <textarea name="message" placeholder="Type message">{{ old('message') }}</textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn centred">
                            <button class="theme-btn btn-one" type="submit" name="submit-form">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- contact-section end -->
@endsection
