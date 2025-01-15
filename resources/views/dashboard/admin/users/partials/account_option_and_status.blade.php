<div>
    <div class="btn-group">
        <button class="btn btn-sm btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown"><i
                class="icon ti-settings"></i>ACCOUNT OPTIONS</button>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item d-flex justify-content-between"
                href="{{ route('admin.users.profile.index', $user->uuid) }}">
                View Profile </a>
            <a class="dropdown-item d-flex justify-content-between"
                href="{{ route('admin.users.transaction.index', $user->uuid) }}">
                Fund Account</a>
            <a class="dropdown-item d-flex justify-content-between"
                href="{{ route('admin.users.withdrawal.index', $user->uuid) }}">
                View Withdrawals</a>
            <a class="dropdown-item d-flex justify-content-between"
                href="{{ route('admin.users.deposit.index', $user->uuid) }}">
                Deposits</a>
            <a class="dropdown-item d-flex justify-content-between"
                href="{{ route('admin.users.notification.index', $user->uuid) }}">
                View Notifications </a>

        </div>
    </div>

    <div class="btn-group">
        <button class="btn btn-sm btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown">
            STATUS</button>
        <div class="dropdown-menu dropdown-menu-end">
            @if ($user->is_account_verified == 0)
                <a class="dropdown-item" href="{{ route('admin.users.verification.skip', $user->uuid) }}">Skip
                    verification</a>
            @else
                <a class="dropdown-item" href="{{ route('admin.users.verification.set', $user->uuid) }}">Set
                    verification</a>
            @endif

            @if ((int) $user->account_state == 0)
                <a class="dropdown-item" href="{{ route('admin.users.account.state.setting.index', $user->uuid) }}">
                    Activate account
                </a>
            @else
                <a class="dropdown-item" href="{{ route('admin.users.account.state.setting.index', $user->uuid) }}">
                    Account settings
                </a>
            @endif
            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                href="{{ route('admin.users.profile.delete', $user->uuid) }}">Delete
                account</a>
        </div>
    </div>
</div>
