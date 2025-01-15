<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Enum\AccountState;
use App\Models\User;
use App\Models\Transfer;
use Illuminate\Support\Str;
use App\Models\TransferCode;
use Illuminate\Http\Request;
use App\Enum\IsAccountVerified;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class InternationalTransferController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'bank_name'         => ['required', 'string', 'max:255'],
            'account_number'    => ['required',  'numeric'],
            'account_name'      => ['required', 'string', 'max:255'],
            'description'       => ['nullable'],
            'amount'            => ['required', 'numeric'],
            'swift_code'        => ['nullable',  'max:255'],
            'iban_code'         => ['nullable',  'max:255'],
            'routing_number'    => ['nullable',  'max:255'],
            'transfer_pin'      => ['required', 'numeric'],
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
            'bank_name'         => $request->bank_name,
            'account_number'    => $request->account_number,
            'account_name'      => $request->account_name,
            'amount'            => $request->amount,
            'description'       => $request->description,
            'swift_code'        => $request->swift_code,
            'iban_code'         => $request->iban_code,
            'routing_number'    => $request->routing_number,
            'reference_id'      => $referenceId,
            'type'              => 'International Transfer',
        ];

        $transferCode = new TransferCode();
        $transferCode->createTransferCode($referenceId, $user);

        Transfer::create($data);

        return redirect()->route('user.transfer.preview', $referenceId)->with('success', 'Please preview details to continue.');
    }
}
