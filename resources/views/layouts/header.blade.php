<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="large-container">
            <div class="top-inner">
                <ul class="info-list clearfix">
                    <li>
                        <i class="icon-1"></i>
                        <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a>
                    </li>
                    @if (config('app.address'))
                        <li>
                            <i class="icon-2"></i>
                            {{ config('app.address') }}
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="large-container">
            <div class="outer-box">
                <div class="logo-box">
                    <div class="shape"></div>
                    <figure class="logo"><a href="/"><img width="200"
                                src="/dashboard/resources/images/logo1.png" alt=""></a></figure>
                </div>
                <div class="menu-area">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light clearfix">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li class="{{ request()->routeIs('home') ? 'current' : '' }}"><a href="/">Home</a>
                                </li>
                                <li class="{{ request()->routeIs('about') ? 'current' : '' }}"><a
                                        href="{{ route('about') }}">About</a></li>
                                <li class="{{ request()->routeIs('services') ? 'current' : '' }}"><a
                                        href="{{ route('services') }}">Services</a></li>
                                <li class="{{ request()->routeIs('contact') ? 'current' : '' }}"><a
                                        href="{{ route('contact') }}">Contact</a></li>
                                <li class="{{ request()->routeIs('loan') ? 'current' : '' }}"><a
                                        href="{{ route('loan') }}">Loans</a></li>
                                <li class="d-md-none d-lg-none"><a href="{{ route('register') }}">Open Account</a></li>
                                <li class="d-md-none d-lg-none"><a href="{{ route('login') }}">Login</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="menu-right-content ml_70">
                        <a href="{{ route('register') }}" class="theme-btn btn-two mr_20">Open Account</a>
                        <a href="{{ route('login') }}" class="theme-btn btn-two mr_20">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="large-container">
            <div class="outer-box">
                <div class="logo-box">
                    <div class="shape"></div>
                    <figure class="logo"><a href="/"><img width="200"
                                src="/dashboard/resources/images/logo1.png" alt=""></a></figure>
                </div>
                <div class="menu-area">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                    <div class="menu-right-content ml_70">
                        <a href="{{ route('register') }}" class="theme-btn btn-two mr_20">Open Account</a>
                        <a href="{{ route('login') }}" class="theme-btn btn-two mr_20">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
