<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Admin;
use App\Models\Deposit;
use App\Trait\ImageUpload;
use App\Enum\DepositStatus;
use App\Helpers\UserHelper;
use Illuminate\Support\Str;
use App\Rules\ValidCardDate;
use Illuminate\Http\Request;
use App\Enum\IsAccountVerified;
use App\Http\Controllers\Controller;

class DepositController extends Controller
{
    use ImageUpload;
    public function index()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();

        $deposits = Deposit::where('user_id', $user->id)->latest()->take(3)->get();

        $data = [
            'title' => 'Deposits',
            'user' => $user,
            'deposits' => $deposits,
            'admin' => $admin
        ];

        return view('dashboard.user.deposit.index', $data);
    }
    public function card()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();

        $data = [
            'title' => 'Card deposit',
            'user' => $user,
            'admin' => $admin
        ];

        return view('dashboard.user.deposit.card', $data);
    }
    public function cardStore(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'card_number' => 'required|numeric|max_digits:16|min_digits:16',
            'card_cvv' => 'required|numeric|max_digits:3|min_digits:3',
            'card_date' => ['required', new ValidCardDate()],
        ], [
            'card_date.required' => 'Card expiry date is required',
            'card_number.size' => 'Invalid card number',
            'card_cvv.size' => 'Invalid cvv number',
        ]);

        $user = User::findOrFail(auth('user')->user()->id);

        if ($user->is_account_verified == IsAccountVerified::UNVERIFIED->value) {
            return redirect()->back()->withErrors(['amount' => 'Please verify your account first before proceeding.']);
        }

        $data = [
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'reference_id' => random_int(10000000, 99999999),
            'amount' => $request->amount,
            'date' => now(),
            'method' => 'Card',
            'card_number' => $request->card_number,
            'cvv' => $request->card_cvv,
            'card_expiry_date' => $request->card_date,
            'status' => DepositStatus::PENDING->value,
        ];

        Deposit::create($data);

        return redirect()->route('user.deposit.index')->with('success', 'Card deposit request sent successfully. Please wait for approval');
    }
    public function bitcoin()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);

        $admin = Admin::where('registration_token', $user->registration_token)->first();

        $data = [
            'title' => 'Bitcoin deposit',
            'user' => $user,
            'admin' => $admin
        ];

        return view('dashboard.user.deposit.bitcoin', $data);
    }

    public function bitcoinStore(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
        ], [
            'amount.required' => 'Please enter amount deposited to continue',
        ]);

        $user = User::findOrFail(auth('user')->user()->id);

        if ($user->is_account_verified == IsAccountVerified::UNVERIFIED->value) {
            return redirect()->back()->withErrors(['amount' => 'Please verify your account first before proceeding.']);
        }

        $data = [
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'reference_id' => random_int(10000000, 99999999),
            'amount' => $request->amount,
            'date' => now(),
            'method' => 'Bitcoin',
            'status' => DepositStatus::PENDING->value,
        ];

        Deposit::create($data);

        return redirect()->route('user.deposit.index')->with('success', 'Bitcoin deposit request sent successfully. Please wait for approval');
    }

    public function show($uuid)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $deposit = Deposit::where('uuid', $uuid)->first();

        $data = [
            'title' => 'Deposit Details',
            'deposit' => $deposit,
            'user' => $user,
            'admin' => $admin
        ];
        return view('dashboard.user.deposit.show', $data);
    }

    public function uploadProof(Request $request, $uuid)
    {
        $request->validate([
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $deposit = Deposit::where('uuid', $uuid)->first();

        $deposit->proof = $this->uploadImage($request, 'proof', 'uploads/users/deposit/');

        $deposit->save();

        return redirect()->route('user.deposit.show', $deposit->uuid)->with('success', 'Proof uploaded successfully');
    }

    public function history()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $deposits = Deposit::where('user_id', $user->id)->latest()->get();

        $data = [
            'title' => 'Deposit History',
            'deposits' => $deposits,
            'user' => $user,
            'admin' => $admin
        ];
        return view('dashboard.user.deposit.history', $data);
    }
}
