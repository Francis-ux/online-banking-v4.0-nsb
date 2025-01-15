<div class="btn-group">
    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        MENU
    </button>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item d-flex justify-content-between align-items-center"
            href="{{ route('user.dashboard') }}"><span class="mr-5">Account Summary </span><i
                class="fa fa-user text-primary" aria-hidden="true"></i> </a>
        <a class="dropdown-item d-flex justify-content-between align-items-center"
            href="{{ route('user.profile.index') }}"><span class="mr-5">Profile</span> <i
                class="fa fa-user text-primary" aria-hidden="true"></i> </a>
        <a class="dropdown-item d-flex justify-content-between align-items-center"
            href="{{ route('user.transaction.index') }}">
            <span class="mr-5">Transactions</span>
            <i class="fa fa-address-book text-primary" aria-hidden="true"></i> </a>
        <a class="dropdown-item d-flex justify-content-between align-items-center"
            href="{{ route('user.transfer.index') }}">
            <span class="mr-5">Transfers</span><i class="fa fa-sticky-note text-primary" aria-hidden="true"></i> </a>
        <a class="dropdown-item d-flex justify-content-between align-items-center"
            href="{{ route('user.deposit.index') }}">
            <span class="mr-5">Deposits</span><i class="fa fa-sticky-note text-primary" aria-hidden="true"></i> </a>
        <a class="dropdown-item d-flex justify-content-between align-items-center"
            href="{{ route('user.notification.index') }}">
            <span class="mr">Notifications</span><i class="fa fa-bell text-primary"></i> </a>
    </div>
</div>
