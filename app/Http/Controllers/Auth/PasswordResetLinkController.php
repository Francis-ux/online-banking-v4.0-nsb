<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Models\PasswordResetToken;
use App\Http\Controllers\Controller;
use App\Mail\PasswordResetLink;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{

    public function create()
    {
        return view('auth.forgot_password', ['title' => 'Forgot Password']);
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email.']);
        }

        $token = Str::random(64);

        $user->password_reset_token = $token;
        $user->save();

        $passwordResetLink = route('password.reset', ['token' => $user->password_reset_token, 'email' => $user->email]);

        AdminHelper::mailConfig($user->registration_token);

        try {
            Mail::to($user->email)->send(new PasswordResetLink($user, $passwordResetLink, 'My' . ' ' . config('app.name') . ' :: Password Reset Link' . ' ' . now()));
            return redirect()->back()->with('success', 'Password reset link sent successfully. Please check your email.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while attempting to send the email. Please try again later.');
        }
    }
}
