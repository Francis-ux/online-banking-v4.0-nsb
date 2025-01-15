<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use App\Enum\AccountState;
use App\Enum\AdminStatus;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use App\Mail\LoginVerification;
use App\Enum\ShouldLoginRequireCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login', ['title' => 'Login Account']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'login'     => ['required'],
            'password'  => ['required'],
        ], ['login.required' => 'Please enter your account number or email.']);

        $login    = $request->login;
        $password = $request->password;
        $remember = $request->remember;

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'account_number';

        $credentials = [$fieldType => $login, 'password' => $password];

        if (auth('user')->attempt($credentials, $remember)) {
            $user = auth('user')->user();
            if (auth('user')->user()->account_state == AccountState::Disabled->value) {
                Auth::guard('user')->logout();
                if ($user->account_state_reason != null) {
                    return back()->with('error', $user->account_state_reason);
                } else {
                    return back()->with('error', 'Your account has been disabled please contact support for more information.');
                }
            }

            if (auth('user')->user()->should_login_require_code == ShouldLoginRequireCode::YES->value) {
                $user = User::findOrFail(Auth::guard('user')->user()->id);
                AdminHelper::mailConfig($user->registration_token);
                $user->login_code = getRandomNumber(4);
                $user->save();
                Mail::to($user->email)->send(new LoginVerification($user, 'My' . ' ' . config('app.name') . ' :: Account Login Code' . ' ' . now()));
                Auth::guard('user')->logout();
                return redirect()->route('login.verification.index', ['uuid' => $user->uuid])->with('success', 'Enter the security code sent to your email.');
            }

            return redirect()->route('user.dashboard');
        }

        if (auth('admin')->attempt($credentials, $remember)) {
            if (auth('admin')->user()->status == AdminStatus::INACTIVE->value) {
                Auth::guard('admin')->logout();
                return back()->withErrors([
                    'login' => 'Your account has been disabled please contact support for more information.',
                ])->onlyInput('login');
            }
            return redirect()->route('admin.dashboard')->with('success', 'Welcome ' . auth('admin')->user()->name . ' Administrator');
        }

        if (auth('master')->attempt($credentials, $remember)) {
            return redirect()->route('master.dashboard')->with('success', 'Welcome ' . auth('master')->user()->name . ' Master Administrator');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    public function destroy()
    {
        if (auth()->guard('user')->check()) {
            $user = User::findOrFail(auth('user')->user()->id);
            $user->last_login_time = now();
            $user->save();
            Auth::guard('user')->logout();
        }

        Auth::guard('admin')->logout();

        Auth::guard('master')->logout();

        return redirect('/login');
    }
}
