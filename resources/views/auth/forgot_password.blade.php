<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{ asset('dashboard/resources/images/logo.png') }}">

        <title>{{ $title }}</title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href="/dashboard/resources/css/vendors_css.css">
        <!-- Style-->
        <link rel="stylesheet" href="/dashboard/resources/css/style.css">
        <link rel="stylesheet" href="/dashboard/resources/css/skin_color.css">
        <style>
            iframe {
                display: none;
            }
        </style>
        <style>
            img[alt*="000webhost"],
            img[alt*="000webhost"][style],
            img[src*="000webhost"],
            img[src*="000webhost"][style],
            body>div:nth-last-of-type(1)[style] {
                opacity: 0 !important;
                pointer-events: none !important;
                width: 0px !important;
                height: 0px !important;
                visibility: hidden !important;
                display: none !important;
            }
        </style>
    </head>

    <body class="hold-transition theme-primary bg-img  text-primary"
        style="background-image: url(/theme/bitcoin/images/backgrounds/call-to-action-bg.jpg); background-size:contain">
        @include('partials.theme_alert')
        <div class="container">
            <div class="row">
                <div class="bg-white shadow-lg col-md-6 offset-md-3 col-12 mt-100 p-5">
                    <div class=" rounded10 ">
                        <div class="content-top-agile p-20 pb-0">
                            <a href="/"><img width="300"
                                    src="{{ asset('dashboard/resources/images/logo2.png') }}"
                                    alt="{{ config('app.name') }}"></a>
                            <h3 class="text-primary">Forgot Your Password?</h3>
                            <p class="mb-0">We get it, stuff happens. Just enter your email address below and we'll
                                send you a link to reset your password!</p>
                        </div>
                        <div class="p-40">
                            <form class="user" method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        name="email" placeholder="Enter account email address"
                                        value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block mt-5">
                                    Email Password Reset Link
                                </button>
                            </form>
                            <div class="text-center">
                                <p class="mt-15 mb-0 text-primary">Don't have an account? <a
                                        href="{{ route('register') }}" class="text-warning ms-5">Register account</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        <script>
            var myModal = new bootstrap.Modal(document.getElementById('modal-center'), {
                keyboard: false
            })
            myModal.show();
        </script>
    </body>

</html>
