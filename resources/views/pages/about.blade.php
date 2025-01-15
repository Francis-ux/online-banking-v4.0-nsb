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

    <!-- about-section -->
    <section class="about-section pt_120 pb_120">
        <div class="pattern-layer rotate-me"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image_block_one">
                        <div class="image-box pr_90 mr_40">
                            <div class="image-shape" style="background-image: url(/assets/images/shape/shape-3.png);"></div>
                            <figure class="image"><img src="/assets/images/resource/about-1.jpg" alt=""></figure>
                            <div class="rating-box">
                                <ul class="rating mb_5 clearfix">
                                    <li><i class="icon-9"></i></li>
                                    <li><i class="icon-9"></i></li>
                                    <li><i class="icon-9"></i></li>
                                    <li><i class="icon-9"></i></li>
                                    <li><i class="icon-9"></i></li>
                                </ul>
                                <h6>5 Star Rating Bank</h6>
                            </div>
                            <div class="experience-box">
                                <div class="inner">
                                    <h2>40</h2>
                                    <h6>Years of Experiense</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content_block_one">
                        <div class="content-box ml_40">
                            <div class="sec-title mb_20">
                                <h6>About Us</h6>
                                <h2>Empowering Financial Success.</h2>
                            </div>
                            <div class="text-box mb_40">
                                <p>Unlock your financial potential with us. We provide expert guidance tailored to your
                                    unique journey, ensuring a secure future.</p>
                            </div>
                            <div class="inner-box mb_45">
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-10"></i></div>
                                    <h3>Personalized Solutions</h3>
                                    <p>Our solutions are designed with your goals in mind, delivering personalized
                                        strategies for your financial well-being.</p>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="icon-11"></i></div>
                                    <h3>Proven Track Record</h3>
                                    <p>With a track record of success, we ensure 99.99% reliability in achieving your
                                        financial milestones.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="feature-style-three pt_120 pb_90">
        <div class="auto-container">
            <div class="sec-title mb_70 centred">
                <h6>Why Choose Us</h6>
                <h2>Our Advantages</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-5"></i></div>
                            <h4><a href="{{ route('login') }}">Secure International Transactions</a></h4>
                            <p>Benefit from our robust security measures for international transactions, ensuring your peace
                                of mind.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-6"></i></div>
                            <h4><a href="{{ route('login') }}">24/7 Expert Support</a></h4>
                            <p>Receive dedicated support from our expert team, available round-the-clock to address your
                                queries.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-7"></i></div>
                            <h4><a href="{{ route('login') }}">Competitive Processing Fees</a></h4>
                            <p>Enjoy lower processing fees compared to other banks, providing you with cost-effective
                                solutions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 feature-block">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="icon-box"><i class="icon-8"></i></div>
                            <h4><a href="{{ route('login') }}">Efficient Loan Approvals</a></h4>
                            <p>Experience faster loan approvals with our streamlined processes, saving you valuable time.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature-style-three end -->
@endsection
