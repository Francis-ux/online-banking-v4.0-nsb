<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\TransferCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateTransferCodeController extends Controller
{
    public function store(Request $request, $referenceId, $orderNo)
    {
        $request->validate([
            'code' => ['required'],
        ]);
        $user = User::findOrFail(auth('user')->user()->id);

        $transferCode = TransferCode::where('code', $request->code)->where('order_no', $orderNo)->where('transfer_reference_id', $referenceId)->first();

        $transferCodeCounts = TransferCode::where('transfer_reference_id', $referenceId)->where('user_id', $user->id)->count();

        if ($transferCode) {
            if ($orderNo >= $transferCodeCounts) {
                return redirect()->route('user.transfer.confirm', $referenceId);
            } else {
                $orderNo += 1;
                return redirect()->route('user.transfer.process', [$referenceId, $orderNo]);
            }
        } else {
            return redirect()->back()->withErrors(['code' => 'Invalid code.']);
        }
    }
}
