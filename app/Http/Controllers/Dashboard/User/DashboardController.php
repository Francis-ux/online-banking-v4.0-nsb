<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Admin;
use App\Enum\AccountState;
use App\Helpers\TimeHelper;
use App\Helpers\UserHelper;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $userCountry = getUserCountry();
        $userCountryTest = getUserCountryTest();

        $timeOfDay = TimeHelper::getTimeOfDay();

        switch ($timeOfDay) {
            case 'morning':
                $greeting = "Good Morning";
                break;
            case 'afternoon':
                $greeting = "Good Afternoon";
                break;
            case 'evening':
                $greeting = "Good Evening";
                break;
            case 'night':
                $greeting = "Good Night";
                break;
        }


        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $accountStates = AccountState::cases();
        $transactions = Transaction::where('user_id', $user->id)->latest()->take(2)->get();
        $transfers = Transaction::where('user_id', $user->id)->count();

        $data = [
            'title' => $greeting . ' ' . $user->first_name . ' ' . $user->last_name,
            'user'  => $user,
            'accountStates' => $accountStates,
            'transactions' => $transactions,
            'transfers' => $transfers,
            'admin' => $admin,
            'greeting' => $greeting,
            'userCountry' => $userCountry,
            'userCountryTest' => $userCountryTest
        ];
        return view('dashboard.user.dashboard', $data);
    }
}
