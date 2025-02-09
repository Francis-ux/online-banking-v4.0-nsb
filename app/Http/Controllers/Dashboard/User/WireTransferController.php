<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Enum\AccountState;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enum\IsAccountVerified;
use App\Enum\TransactionStatus;
use App\Enum\TransferStatus;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\Transfer;

class WireTransferController extends Controller
{
    public function getAccountNumber(Request $request)
    {
        try {
            $user = User::where('account_number', $request->accountNumber)->first();

            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'account_name' => "{$user->first_name} {$user->last_name}",
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Account not found',
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database query exceptions
            Log::error('Database error: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Database error',
            ], 500);
        } catch (\Exception $e) {
            // Handle other exceptions
            Log::error('An error occurred: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred',
            ], 500);
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'account_number'    => ['required',  'numeric'],
            'account_name'      => ['required', 'string', 'max:255'],
            'description'       => ['nullable'],
            'amount'            => ['required', 'numeric'],
            'transfer_pin'      => ['required', 'numeric'],
        ]);
        // Check if receiver account exists
        $receiverUser = User::where('account_number', $request->account_number)->first();
        if (!$receiverUser) {
            return redirect()->back()->with('error', 'Account not found');
        }

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
            'bank_name'         => config('app.name'),
            'account_number'    => $request->account_number,
            'account_name'      => $request->account_name,
            'amount'            => $request->amount,
            'description'       => $request->description,
            'reference_id'      => $referenceId,
            'type'              => 'Wire Transfer',
            'receiver_account_number' => $request->account_number
        ];

        Transfer::create($data);

        session()->put('receiverAccountNumber', $receiverUser->account_number);

        return redirect()->route('user.transfer.preview', $referenceId)->with('success', 'Please preview details to continue.');
    }
}
