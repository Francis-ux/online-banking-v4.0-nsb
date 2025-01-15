<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Enum\AccountState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAccountStateSettingController extends Controller
{
    public function index(string $uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();
        $accountStates = AccountState::cases();

        $data = [
            'title' => 'User account state setting',
            'user'  => $user,
            'admin' => $admin,
            'accountStates' => $accountStates,
        ];

        return view('dashboard.admin.users.account_state_setting.index', $data);
    }
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'account_state' => ['required', 'numeric'],
            'account_state_reason' => ['nullable', 'max:255'],
        ]);

        $user = User::where('uuid', $uuid)->first();
        $user->account_state = $request->account_state;
        $user->account_state_reason = $request->account_state_reason ?? null;
        $user->save();

        return redirect()->back()->with('success', 'User account state updated successfully');
    }
}
