<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li>
                        <div id="google_translate_element"></div>
                    </li>
                    <li>
                        <a href="{{ route('master.dashboard') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-laptop" aria-hidden="true"></i>
                            <span>Accounts</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('master.dashboard') }}"><span>Registered Admin</span></a>
                            </li>
                            <li>
                                <a href="{{ route('master.admin.create') }}"><span>Register Admin</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cog" aria-hidden="true"></i> <span>Settings</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{ route('master.profile.index') }}"><span>Profile</span></a>
                            </li>
                        </ul>
                    </li>
            </div>
        </div>
    </section>
</aside>
