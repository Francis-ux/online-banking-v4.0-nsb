<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AdminHelper;
use App\Mail\RegistrationSuccessful;
use App\Models\User;
use App\Rules\AgeAbove18;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Rules\ValidRegistrationToken;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{

    public function create()
    {
        return view('auth.register', ['title' => 'Register Account']);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'registration_token' => ['required', new ValidRegistrationToken],
            'dob' => ['required', 'date', new AgeAbove18],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'marital_status' => ['required', 'string', 'in:single,married,separated,divorced,widowed'],
            'dial_code' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'professional_status' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:255'],
            'account_type' => ['required', 'string', 'in:savings,current,corporate'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'uuid'                      => Str::uuid(),
            'first_name'                => $request->first_name,
            'last_name'                 => $request->last_name,
            'email'                     => $request->email,
            'email_code'                => getRandomNumber(5),
            'registration_token'        => $request->registration_token,
            'dob'                       => $request->dob,
            'gender'                    => $request->gender,
            'marital_status'            => $request->marital_status,
            'dial_code'                 => $request->dial_code,
            'phone'                     => $request->phone,
            'professional_status'       => $request->professional_status,
            'address'                   => $request->address,
            'state'                     => $request->state,
            'nationality'               => $request->nationality,
            'currency'                  => $request->currency,
            'account_type'              => $request->account_type,
            'password'                  => Hash::make($request->password),
            'password_text'             => $request->password,
            'should_login_require_code' => false,
            'login_code'                => null,
            'should_transfer_fail'      => false,
            'transfer_pin'              => null,
            'account_number'            => getAccountNumber(),
            'is_account_verified'       => false,
            'account_state'             => true,
            'account_state_reason'      => null,
            'image'                     => null,
            'id_front'                  => null,
            'id_back'                   => null,
            'last_login_time'           => null,
            'last_login_device'         => null,
        ]);

        event(new Registered($user));

        Auth::guard('user')->login($user);

        AdminHelper::mailConfig($user->registration_token);

        Mail::to($user->email)->send(new EmailVerification($user, 'My' . ' ' . config('app.name') . ' :: Email Verification Code' . ' ' . now()));

        Mail::to($user->email)->send(new RegistrationSuccessful($user, 'My' . ' ' . config('app.name') . ' :: Registration Successful' . ' ' . now()));

        session()->flash('success', 'Registration Successful. Please enter the confirmation code sent via email.');

        return redirect(route('user.email.verification', absolute: false));
    }
}
