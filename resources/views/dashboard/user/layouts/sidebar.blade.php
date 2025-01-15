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
                        <a href="{{ route('user.dashboard') }}">
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
                                <a href="{{ route('user.dashboard') }}"><span>Account Summary</span></a>
                            </li>
                            <li>
                                <a href="{{ route('user.transaction.index') }}"><span>Transactions</span></a>
                            </li>
                            <li>
                                <a href="{{ route('user.transfer.fund') }}"><span>Transfer Fund</span></a>
                            </li>
                            <li>
                                <a href="{{ route('user.transfer.index') }}"><span>Transfer History</span></a>
                            </li>

                            <li>
                                <a href="{{ route('user.deposit.index') }}"><span>Deposit</span></a>
                            </li>
                            <li>
                                <a href="{{ route('user.deposit.history') }}"><span>Deposit History</span></a>
                            </li>
                            <li>
                                <a href="{{ route('user.account.statement.index') }}"><span>Account Statement</span></a>
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
                                <a class="collapse-item" href="{{ route('loan') }}">Loans</a>
                            </li>
                            <li>
                                <a class="collapse-item" href="{{ route('user.card.index') }}">Cards</a>
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
                                <a href="{{ route('user.profile.index') }}"><span>Profile</span></a>
                            </li>
                            <li>
                                <a href="{{ route('user.notification.index') }}"><span>Notifications</span></a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"><span>Logout</span></a>
                            </li>
                        </ul>
                    </li>
            </div>
        </div>
    </section>
</aside>
