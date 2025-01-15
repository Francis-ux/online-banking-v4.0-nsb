<header class="main-header">
    <div class="d-flex align-items-center logo-box justify-content-start">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- logo-->

            <div class="logo-lg">
                <span class="light-logo "><img width="200" src="/dashboard/resources/images/logo2.png"
                        alt="logo"></span>
            </div>
        </a>
    </div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
            <ul class="header-megamenu nav">
                <li class="btn-group nav-item">
                    <a href="#" class="waves-effect waves-light nav-link push-btn btn-primary-light"
                        data-toggle="push-menu" role="button">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <li class="btn-group d-lg-inline-flex d-none">
                    <a href="#" data-provide="fullscreen"
                        class="waves-effect waves-light full-screen btn-warning-light" title="Full Screen">
                        <i class="fa fa-window-maximize" aria-hidden="true"></i>
                    </a>
                </li>
                <!-- User Account-->

                <li class="dropdown user user-menu">
                    <a href="#"
                        class="waves-effect waves-light dropdown-toggle w-auto l-h-12 bg-transparent py-0 no-shadow"
                        data-bs-toggle="dropdown">
                        <div class="d-flex pt-5">
                            @if ($user->image != null)
                                <img style="width: 100%; height:auto; border-radius:5px; border:2px solid gray; overflow:hidden;"
                                    src="{{ asset('uploads/users/image/' . $user->image) }}" alt="No image uploaded">
                            @else
                                <img style="width: 100%; height:auto; border-radius:5px; border:2px solid gray; overflow:hidden;"
                                    src="{{ asset('default.png') }}" alt="No image uploaded">
                            @endif
                        </div>

                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="{{ route('user.dashboard') }}"><i
                                    class="ti-user text-muted me-2"></i>
                                Account Summary</a>
                            <a class="dropdown-item" href="<?= route('logout') ?>"><i
                                    class="ti-lock text-muted me-2"></i> Logout</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
