<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Transfer;
use App\Enum\AccountState;
use Illuminate\Support\Str;
use App\Models\TransferCode;
use Illuminate\Http\Request;
use App\Enum\IsAccountVerified;
use App\Models\VerificationCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ElectronicTransferController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'withdrawal_method' => ['required', 'max:255'],
            'amount'            => ['required','numeric'],
            'beneficiary'       => ['required',  'max:255'],
            'transfer_pin'      => ['required','numeric'],
        ]);

        $user = User::findOrFail(auth('user')->user()->id);

        if ($user->is_account_verified == IsAccountVerified::UNVERIFIED->value) {
            return redirect()->back()->withErrors(['password' => 'Please verify your account first before proceeding.']);
        }

        if ($user->account_state == AccountState::Frozen->value) {
            return redirect()->back()->withErrors(['password' => 'Your account is frozen please contact support team for more information.']);
        }

        if ($user->account_state == AccountState::Kyc->value) {
            return redirect()->back()->withErrors(['password' => 'Your account is under review please contact support team for more information.']);
        }

        if ($request->transfer_pin != $user->transfer_pin) {
            return redirect()->back()->withErrors(['password' => 'The pin you entered is incorrect.']);
        }

        if ($user->balance < $request->amount) {
            return redirect()->back()->withErrors(['amount' => 'Insufficient balance.']);
        }

        $referenceId = rand(222222222, 999999999);

        $data = [
            'uuid'              => Str::uuid(),
            'user_id'           => $user->id,
            'amount'            => $request->amount,
            'withdrawal_method' => $request->withdrawal_method,
            'beneficiary'       => $request->beneficiary,
            'reference_id'      => $referenceId,
            'type'              => 'Electronic Transfer',
        ];

        $transferCode = new TransferCode();
        $transferCode->createTransferCode($referenceId, $user);

        Transfer::create($data);

        return redirect()->route('user.transfer.preview', $referenceId)->with('success', 'Please preview details to continue.');
    }
}
