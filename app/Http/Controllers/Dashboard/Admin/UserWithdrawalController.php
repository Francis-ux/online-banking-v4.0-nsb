<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Transfer;
use App\Models\TransferCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserWithdrawalController extends Controller
{
    public function index($uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();

        $transfers = Transfer::where('user_id', $user->id)->latest()->get();

        $data = [
            'title' => 'User withdrawals',
            'user' => $user,
            'admin' => $admin,
            'transfers' => $transfers,
        ];

        return view("dashboard.admin.users.withdrawal.index", $data);
    }
    public function show(string $uuid, string $referenceId)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();

        $transfer = Transfer::where('user_id', $user->id)->where('reference_id', $referenceId)->first();
        $transferCode = new TransferCode();

        $data = [
            'title' => 'User withdrawal details',
            'user' => $user,
            'admin' => $admin,
            'transfer' => $transfer,
            'transferCodes' => $transferCode->getTransferVerificationData($referenceId)

        ];

        return view("dashboard.admin.users.withdrawal.show", $data);
    }
    public function delete(string $id)
    {
        $transfer = Transfer::where('id', $id)->first();

        $transfer->delete();

        return redirect()->back()->with('success', 'Withdrawal deleted successfully');
    }
}
