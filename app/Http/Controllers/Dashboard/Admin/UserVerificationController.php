<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Enum\IsAccountVerified;
use App\Http\Controllers\Controller;

class UserVerificationController extends Controller
{
    public function skip(string $uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();
        $user->is_account_verified = IsAccountVerified::VERIFIED->value;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->back()->with('success', 'Verification skipped successfully');
    }
    public function set(string $uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();
        $user->is_account_verified = IsAccountVerified::UNVERIFIED->value;
        $user->save();

        return redirect()->back()->with('success', 'Verification set successfully');
    }
}
