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
        style="background-image: url(/theme/bitcoin/images/backgrounds/call-to-action-bg.html); background-size:contain">
        @include('partials.theme_alert')
        <div class="container">
            <div class="row">
                <div class="bg-white shadow-lg col-md-6 offset-md-3 col-12 mt-100 p-5">
                    <div class="rounded10 ">
                        <div class="content-top-agile p-20 pb-0">
                            <a href="/"><img width="300" src="{{ asset('dashboard/resources/images/logo2.png') }}"
                                    alt="{{ config('app.name') }}"></a>
                            <h4 class="text-primary">{{ $title }}</h4>
                            <p class="mb-0">Please enter login credentials</p>
                        </div>
                        <div class="p-40">
                            @if (session('status'))
                                <p class="text-success"> {{ session('status') }}</p>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-transparent">
                                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" placeholder="Enter account number or email"
                                            class="form-control ps-15 bg-transparent" name="login"
                                            value="{{ old('login') }}" autocomplete="login">
                                    </div>
                                    @if ($errors->has('login'))
                                        <p class="text-danger">{{ $errors->first('login') }}</p>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text  bg-transparent">
                                            <i class="fa fa-key" aria-hidden="true"></i>
                                        </span>
                                        <input type="password" placeholder="Enter account password"
                                            class="form-control ps-15 bg-transparent" name="password"
                                            autocomplete="current-password">
                                    </div>
                                    @if ($errors->has('password'))
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="checkbox">
                                            <input type="checkbox" id="remember_me" name="remember">
                                            <label for="remember_me">Remember Me</label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-6">
                                        <div class="fog-pwd text-end">
                                            <a href="{{ route('password.request') }}" class="hover-warning"><i
                                                    class="ion ion-locked"></i>
                                                Forgot password?</a><br>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-danger mt-10">SIGN IN</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
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
        <script src="/dashboard/resources/assets/icons/feather-icons/feather.min.html"></script>

        <!-- <script src="https://legalmining.us/dashboard/resources/assets/vendor_components/apexcharts-bundle/irregular-data-series.js">
        </script> -->
        <!-- <script src="https://legalmining.us/dashboard/resources/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script> -->
        <!-- <script src="https://legalmining.us/dashboard/resources/js/core.js"></script> -->
        <!-- <script src="https://legalmining.us/dashboard/resources/js/charts.js"></script> -->
        <script src="/dashboard/resources/js/themes/animated.js"></script>
        <script src="/dashboard/resources/assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js"></script>
        <script src="/dashboard/resources/assets/vendor_components/moment/min/moment.min.html"></script>
        <script src="/dashboard/resources/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.html"></script>

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
