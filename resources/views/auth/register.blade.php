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
        <div class="container">
            <div class="row">

                <div class="col-12 pt-5">
                    <div class="row justify-content-center g-0">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="bg-white rounded10 shadow-lg">
                                <div class="p-40">
                                    <div class="col-sm-12 col-md-8 offset-md-2 pt-5">
                                        <div class="d-flex justify-content-between">
                                            <a href="/"><img width="300"
                                                    src="{{ asset('dashboard/resources/images/logo2.png') }}"
                                                    alt="{{ config('app.name') }}"></a>
                                        </div>
                                        <div class="text-left">
                                            <h1 class="h4 mb-2">{{ $title }}</h1>
                                            <p>Choose the best account for you and enjoy Online Banking, Mobile Banking,
                                                a debit card with Total Security Protection® - and much more. Apply
                                                today in minutes and get a bank account that works for you.</p>
                                        </div>
                                        @include('partials.validation_message')
                                        <form class="row" method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="mb-2 col-sm-12 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="">First name</label>
                                                    <input type="text" name="first_name"
                                                        value="<?= old('first_name') ?>"
                                                        class="form-control bg-light border-1 small" id=""
                                                        placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Last name</label>
                                                    <input type="text" name="last_name"
                                                        value="<?= old('last_name') ?>"
                                                        class="form-control bg-light border-1 small" id=""
                                                        placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Email address</label>
                                                    <input type="email" name="email" value="<?= old('email') ?>"
                                                        class="form-control bg-light border-1 small"
                                                        id="exampleInputEmail" placeholder="Email Address">
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-12 col-lg-6 ">
                                                <div class="form-group">
                                                    <label for="">Registration token</label>
                                                    <input type="text" name="registration_token"
                                                        value="<?= old('registration_token') ?>"
                                                        class="form-control bg-light border-1 small" id=""
                                                        placeholder="Registration token">
                                                    <input type="hidden" name="referred" value="0">
                                                </div>
                                            </div>

                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="">Date of Birth</label>
                                                    <input value="<?= old('dob') ?>" type="date" name="dob"
                                                        class="form-control bg-light border-1 small" id="">
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="">Gender</label>
                                                    <select class="form-control bg-light border-1 small" name="gender"
                                                        id="">
                                                        <option value="">Select</option>
                                                        <option value="male"
                                                            {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value="female"
                                                            {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option value="other"
                                                            {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <div class="form-group">
                                                    <label for="">Marital Status</label>
                                                    <select name="marital_status" id=""
                                                        class="form-control bg-light border-1 small">
                                                        <option value="">Select</option>
                                                        <option value="single"
                                                            {{ old('marital_status') == 'single' ? 'selected' : '' }}>
                                                            Single</option>
                                                        <option value="married"
                                                            {{ old('marital_status') == 'married' ? 'selected' : '' }}>
                                                            Married</option>
                                                        <option value="separated"
                                                            {{ old('marital_status') == 'separated' ? 'selected' : '' }}>
                                                            Separated</option>
                                                        <option value="divorced"
                                                            {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>
                                                            Divorced</option>
                                                        <option value="widowed"
                                                            {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>
                                                            Widowed</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <label for="">Dial code</label>
                                                <select name="dial_code" id=""
                                                    class="form-control bg-light border-1 small">
                                                    <option value="">Select</option>
                                                    @foreach (config('setting.dial_code') as $key => $dialCode)
                                                        <option value="+{{ $key }}"
                                                            {{ old('dial_code') == '+' . $key ? 'selected' : '' }}>
                                                            {{ $dialCode }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <label for="">Phone</label>
                                                <input type="number" name="phone"
                                                    class="form-control bg-light border-1 small"
                                                    value="<?= old('phone') ?>" placeholder="Phone">
                                            </div>

                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <label for="">Professional Status</label>
                                                <input type="text" placeholder="e.g Employed, Student, Engineer"
                                                    value="<?= old('professional_status') ?>"
                                                    name="professional_status"
                                                    class="form-control bg-light border-1 small">
                                            </div>
                                            <div class="mb-2 col-12">
                                                <label for="">Address</label>
                                                <input type="text" placeholder="Your contact address"
                                                    name="address" value="<?= old('address') ?>"
                                                    class="form-control bg-light border-1 small">
                                            </div>
                                            <div class="mb-2 col-sm-6">
                                                <label for="">State</label>
                                                <input type="text" placeholder="Your state" name="state"
                                                    value="<?= old('state') ?>"
                                                    class="form-control bg-light border-1 small">
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <label for="">Nationality</label>
                                                <select name="nationality" id=""
                                                    class="form-control bg-light border-1 small">
                                                    <option value="">Select</option>
                                                    @foreach (config('setting.nationality') as $key => $nationality)
                                                        <option value="{{ $nationality }}"
                                                            {{ old('nationality') == $nationality ? 'selected' : '' }}>
                                                            {{ $nationality }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <label for="">Currency</label>
                                                <select name="currency" id=""
                                                    class="form-control bg-light border-1 small">
                                                    <option value="">Select</option>
                                                    @foreach (config('setting.currency') as $key => $currency)
                                                        <option
                                                            value="{{ $currency['name'] }}-{{ $currency['code'] }}-{{ $currency['symbol'] }}"
                                                            {{ old('currency') == $currency['name'] . '-' . $currency['code'] . '-' . $currency['symbol'] ? 'selected' : '' }}>
                                                            {{ $currency['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-6 col-md-4">
                                                <label for="">Account Type</label>
                                                <select name="account_type" id=""
                                                    class="form-control bg-light border-1 small">
                                                    <option value="savings" {{ old('account_type') == 'savings' }}>
                                                        Savings account</option>
                                                    <option value="current" {{ old('account_type') == 'current' }}>
                                                        Current Account</option>
                                                    <option value="corporate"
                                                        {{ old('account_type') == 'corporate' }}>Corporate account
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" required name="password" value=""
                                                        class="form-control bg-light border-1 small" id="password"
                                                        placeholder="Password" required autocomplete="new-password">
                                                    @if ($errors->has('password'))
                                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-12 col-md-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="password_confirmation">Confirm Password</label>
                                                    <input type="password" required name="password_confirmation"
                                                        class="form-control bg-light border-1 small" id=""
                                                        placeholder="Repeat Password">
                                                    @if ($errors->has('password_confirmation'))
                                                        <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                                    Create account
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                    <div class="text-center">
                                        <p class="mt-15 mb-0">Already have an account? <a href="{{ route('login') }}"
                                                class="text-warning ms-5">Login account</a></p>
                                    </div>
                                </div>
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
        <script src="/dashboard/resources/assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

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
