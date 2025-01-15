<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        @if (isset($title))
            <title>{{ $title }} &mdash; {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif
        <!-- Description -->
        <meta
            content="Online Banking, Internet Banking, Secure Banking, Financial Management, Fund Transfer, Bill Payments, 24/7 Access, Digital Banking, Personalized Banking"
            name="keywords">
        <meta
            content="Experience secure and convenient online banking with our platform. Manage your finances, transfer funds, and enjoy 24/7 access to your accounts. Explore our advanced features for a seamless and personalized banking experience."
            name="description">
        <meta property="og:title" content="{{ config('app.name') }} - Secure Online Banking" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image"
            content="{{ asset('dashboard/resources/images/istockphoto-1304484797-612x612.jpg') }}" />

        <!-- Favicon -->
        <link rel="shortcut icon" href="/dashboard/resources/images/logo.png">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;display=swap"
            rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
            rel="stylesheet">

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        @include('partials.google_translator')

        <!-- Stylesheets -->
        <link href="/assets/css/font-awesome-all.css" rel="stylesheet">
        <link href="/assets/css/flaticon.css" rel="stylesheet">
        <link href="/assets/css/owl.css" rel="stylesheet">
        <link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/jquery.fancybox.min.css" rel="stylesheet">
        <link href="/assets/css/animate.css" rel="stylesheet">
        <link href="/assets/css/nice-select.css" rel="stylesheet">
        <link href="/assets/css/elpath.css" rel="stylesheet">
        <link href="/assets/css/color/theme-color.css" id="jssDefault" rel="stylesheet">
        <link href="/assets/css/switcher-style.css" rel="stylesheet">
        <link href="/assets/css/rtl.css" rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet">
        <link href="/assets/css/module-css/page-title.css" rel="stylesheet">
        <link href="/assets/css/module-css/banner.css" rel="stylesheet">
        <link href="/assets/css/module-css/feature.css" rel="stylesheet">
        <link href="/assets/css/module-css/about.css" rel="stylesheet">
        <link href="/assets/css/module-css/service.css" rel="stylesheet">
        <link href="/assets/css/module-css/calculator.css" rel="stylesheet">
        <link href="/assets/css/module-css/video.css" rel="stylesheet">
        <link href="/assets/css/module-css/funfact.css" rel="stylesheet">
        <link href="/assets/css/module-css/apps.css" rel="stylesheet">
        <link href="/assets/css/module-css/testimonial.css" rel="stylesheet">
        <link href="/assets/css/module-css/news.css" rel="stylesheet">
        <link href="/assets/css/module-css/subscribe.css" rel="stylesheet">
        <link href="/assets/css/module-css/faq.css" rel="stylesheet">
        <link href="/assets/css/module-css/contact.css" rel="stylesheet">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <link href="/assets/css/responsive.css" rel="stylesheet">

    </head>

    <!-- page wrapper -->

    <body>

        <div class="boxed_wrapper ltr">

            <!-- preloader -->
            @include('layouts.sections.preloader')
            <!-- preloader end -->
            <!-- main header -->
            @include('layouts.header')
            <!-- main-header end -->

            <!-- Mobile Menu  -->
            @include('layouts.sections.mobile_menu')
            <!-- End Mobile Menu -->

            @yield('content')

            <!-- main-footer -->
            @include('layouts.footer')
            <!-- main-footer end -->

            <!--Scroll to top-->
            @include('layouts.sections.scroll_to_top')
            <!-- Scroll to top end -->

        </div>

        <!-- jequery plugins -->
        <script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        <script src="/assets/js/owl.js"></script>
        <script src="/assets/js/wow.js"></script>
        <script src="/assets/js/validation.js"></script>
        <script src="/assets/js/jquery.fancybox.js"></script>
        <script src="/assets/js/appear.js"></script>
        <script src="/assets/js/isotope.js"></script>
        <script src="/assets/js/parallax-scroll.js"></script>
        <script src="/assets/js/jquery.nice-select.min.js"></script>
        <script src="/assets/js/jQuery.style.switcher.min.js"></script>
        <script src="/assets/js/emi-calculator.js"></script>

        <!-- main-js -->
        <script src="/assets/js/script.js"></script>

        @include('partials.live_chat')

    </body><!-- End of .page_wrapper -->

</html>
