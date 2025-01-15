<footer class="main-footer">
    <div class="widget-section">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(/assets/frontend/assets/images/shape/shape-8.png);"></div>
            <div class="pattern-2" style="background-image: url(/assets/frontend/assets/images/shape/shape-9.png);"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget logo-widget">
                        <figure class="footer-logo"><a href="/"><img width="200"
                                    src="/dashboard/resources/images/logo1.png" alt=""></a></figure>
                        <p class="text-capitalize">we're dedicated to being your reliable financial partner, offering
                            personalized solutions and unwavering commitment to your success. Join us in achieving your
                            financial goals with transparency, security, and excellence.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget ml_40">
                        <div class="widget-title">
                            <h4>Explore</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="/">Home</a></li>
                                <li><a href="{{ route('about') }}">About Us</a></li>
                                <li><a href="{{ route('services') }}">Services</a></li>
                                <li><a href="{{ route('faq') }}">Faq’s</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                    <div class="footer-widget links-widget">
                        <div class="widget-title">
                            <h4>Useful Links</h4>
                        </div>
                        <div class="widget-content">
                            <ul class="links-list clearfix">
                                <li><a href="{{ route('login') }}">Credit Card</a></li>
                                <li><a href="{{ route('login') }}">Saving Account</a></li>
                                <li><a href="{{ route('login') }}">Apply for Loans</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-bottom centred">
        <div class="auto-container">
            <div class="copyright">
                <p>Copyright {{ date('Y') }} by <a href="/">{{ config('app.name') }}</a>. All Right Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
