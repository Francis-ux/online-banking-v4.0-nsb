<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Admin;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $data = [
            'title' => 'User Email Verification',
            'user'  => $user,
            'admin' => $admin
        ];

        return view('dashboard.user.email_verification.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);

        $user = User::findOrFail(auth('user')->user()->id);

        if ($user->email_code == $request->code) {
            $user->email_verified_at = Carbon::now();
            $user->save();

            return redirect()->route('user.dashboard')->with('success', 'Email verified successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid email verification code');
        }
    }
    public function resend()
    {
        $user = User::findOrFail(auth('user')->user()->id);

        $user->email_code = getRandomNumber(5);
        $user->save();
        AdminHelper::mailConfig($user->registration_token);
        Mail::to($user->email)->send(new EmailVerification($user, 'My' . ' ' . config('app.name') . ' :: Email Verification Code' . now()));

        return redirect()->route('user.email.verification')->with('success', 'Email verification code sent successfully');
    }
}
