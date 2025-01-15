<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Mail\LoginVerification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class LoginVerificationController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('uuid', $request->uuid)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found');
        }

        $data = [
            'title' => 'Login Email Verification',
            'user'  => $user
        ];

        return view('auth.login_verification.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ], [
            'code.required' => 'Please enter verification code',
            'code.numeric' => 'Invalid verification code',
        ]);

        $user = User::where('uuid', $request->uuid)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found');
        }

        if ($user->login_code == $request->code) {
            auth('user')->login($user);
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid verification code');
        }
    }
    public function resend(Request $request)
    {
        $user = User::where('uuid', $request->uuid)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found');
        }

        $user->login_code = getRandomNumber(4);
        $user->save();
        AdminHelper::mailConfig($user->registration_token);
        Mail::to($user->email)->send(new LoginVerification($user, 'My' . ' ' . config('app.name') . ' :: Account Login Code' . ' ' . now()));

        return redirect()->route('login.verification.index', ['uuid' => $user->uuid])->with('success', 'Enter the security code sent to your email.
');
    }
}
