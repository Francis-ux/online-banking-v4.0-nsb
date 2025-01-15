<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Description -->
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
        <!-- End Description -->
        <link rel="icon" href="/dashboard/resources/images/logo.png">

        <title>{{ $title }}</title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href="/dashboard/resources/css/vendors_css.css">
        <!-- Style-->
        <link rel="stylesheet" href="/dashboard/resources/css/style.css">
        <link rel="stylesheet" href="/dashboard/resources/css/skin_color.css">
        @include('partials.google_translator')
    </head>

    <body class=" sidebar-mini theme-primary fixed   light-skin ">

        <div class="wrapper">
            @include('dashboard.admin.layouts.header')
            @include('dashboard.admin.layouts.sidebar')

            @include('partials.theme_alert')
            @yield('content')
            @include('dashboard.admin.layouts.footer')

            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->
        <!-- Vendor JS -->
        <script src="/dashboard/resources/js/vendors.min.js"></script>
        <script src="/dashboard/resources/js/pages/chat-popup.js"></script>
        <script src="/dashboard/resources/assets/icons/feather-icons/feather.min.js"></script>

        <script src="/dashboard/resources/js/themes/animated.js"></script>
        <script src="/dashboard/resources/assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js"></script>
        <script src="/dashboard/resources/assets/vendor_components/moment/min/moment.min.js"></script>
        <script src="/dashboard/resources/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
        </script>

        <!-- Specie Admin Admin App -->
        <script src="/dashboard/resources/js/demo.js"></script>
        <script src="/dashboard/resources/js/template.js"></script>
        <script src="/dashboard/resources/js/pages/dashboard.js"></script>
        @include('partials.live_chat')
    </body>

</html>
<script defer>
    window.addEventListener('load', function() {
        const banner = document.querySelector('.disclaimer');
        banner.remove();
    })
</script>
<script src="/dashboard/resources/js/rollup.js"></script>
<script src="/dashboard/resources/js/counter.js"></script>

<script>
    var myModal = new bootstrap.Modal(document.getElementById('modal-center'), {
        keyboard: false
    })
    myModal.show();
</script>
