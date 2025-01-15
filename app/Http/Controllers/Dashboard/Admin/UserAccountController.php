<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Enum\AccountState;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enum\IsAccountVerified;

class UserAccountController extends Controller
{
    public function verified()
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $users = User::where('registration_token', $admin->registration_token)->where('is_account_verified', IsAccountVerified::VERIFIED->value)->latest()->get();

        $data = [
            'title' => 'Verified Users',
            'admin' => $admin,
            'users' => $users,
        ];

        return view('dashboard.admin.users.account.verified', $data);
    }
    public function unverified()
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $users = User::where('registration_token', $admin->registration_token)->where('is_account_verified', IsAccountVerified::UNVERIFIED->value)->latest()->get();

        $data = [
            'title' => 'Unverified Users',
            'admin' => $admin,
            'users' => $users,
        ];

        return view('dashboard.admin.users.account.unverified', $data);
    }
    public function disabled()
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $users = User::where('registration_token', $admin->registration_token)->where('account_state', AccountState::Disabled->value)->latest()->get();

        $data = [
            'title' => 'Disabled Users',
            'admin' => $admin,
            'users' => $users,
        ];

        return view('dashboard.admin.users.account.disabled', $data);
    }
    public function all()
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $users = User::where('registration_token', $admin->registration_token)->latest()->get();

        $data = [
            'title' => 'All Users',
            'admin' => $admin,
            'users' => $users,
        ];

        return view('dashboard.admin.users.account.all', $data);
    }
}
