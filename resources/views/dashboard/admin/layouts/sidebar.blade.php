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
                        <a href="{{ route('admin.dashboard') }}">
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
                        <ul class="treeview-menu" style="display: none;">
                            <li>
                                <a href="{{ route('admin.users.account.verified') }}">Verified
                                    accounts</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.account.unverified') }}">Unverified
                                    accounts</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.account.disabled') }}">Disabled
                                    accounts</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.account.all') }}">All accounts</a>
                            </li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file" aria-hidden="true"></i> <span>Applications</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a class="collapse-item" href="{{ route('admin.loan.index') }}">Loans</a>
                            </li>
                            <li>
                                <a class="collapse-item" href="{{ route('admin.card.index') }}">Cards</a>
                            </li>

                        </ul>
                        <!-- FALSE -->
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
                                <a href="{{ route('admin.verification.code.index') }}"><span>Verification
                                        codes</span></a>
                            </li>
                            <li>
                                <a href="{{ route('admin.contact.message.index') }}"><span>Contact messages</span></a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile.index') }}"><span>Profile</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
