<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Transfer;
use Illuminate\Support\Str;
use App\Enum\TransferStatus;
use App\Models\TransferCode;
use Illuminate\Http\Request;
use App\Enum\TransactionStatus;
use App\Helpers\AdminHelper;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\Transfer as TransferMail;

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
            'transferCodes' => $transferCode->getTransferVerificationData($referenceId),
            'transferStatus' => TransferStatus::cases()

        ];

        return view("dashboard.admin.users.withdrawal.show", $data);
    }
    public function update(Request $request, string $uuid, string $referenceId)
    {
        $request->validate([
            'other_status' => 'required',
            'message' => 'nullable',
        ]);

        $data = [
            'other_status' => $request->other_status,
            'message' => $request->message
        ];

        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();

        $transfer = Transfer::where('user_id', $user->id)->where('reference_id', $referenceId)->first();

        $transfer->update($data);

        return redirect()->back()->with('success', 'Withdrawal updated successfully');
    }
    public function delete(string $id)
    {
        $transfer = Transfer::where('id', $id)->first();

        $transfer->delete();

        return redirect()->back()->with('success', 'Withdrawal deleted successfully');
    }

    public function failed(string $uuid, string $referenceId)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();

        $transfer = Transfer::where('user_id', $user->id)->where('reference_id', $referenceId)->first();

        $transfer->update([
            'status' => TransferStatus::Failed->value,
            'other_status' => TransferStatus::Failed->value,
            'message' => 'Withdrawal failed'
        ]);

        return redirect()->back()->with('success', 'Withdrawal failed successfully');
    }
    public function approve(string $uuid, string $referenceId)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();

        $transfer = Transfer::where('user_id', $user->id)->where('reference_id', $referenceId)->first();

        if ($transfer->type == 'Wire Transfer') {
            // Check if receiver account exists
            $receiverUser = User::where('account_number', $transfer->receiver_account_number)->first();
            if (!$receiverUser) {
                return redirect()->back()->with('error', 'Account not found');
            }
        }

        $description = '';

        if ($transfer->type == "Domestic Transfer") {
            $description = 'Electronic TF: ' . $transfer->withdrawal_method . '/';
        } elseif ($transfer->type == "International Transfer") {
            $description = 'International TF: ' . $transfer->bank_name . '/' . $transfer->account_name;
        } else {
            $description = 'Wire TF: ' . $transfer->bank_name . '/' . $transfer->account_name;
        }

        $transactionData = [
            'uuid'          => Str::uuid(),
            'user_id'       => $user->id,
            'type'          => 'DEBIT',
            'description'   => $transfer->description ?? $description,
            'amount'        => $transfer->amount,
            'date'          => date('Y-m-d'),
            'time'          => date('H:i:s'),
            'reference_id'  => $transfer->reference_id,
            'status'        => TransactionStatus::SUCCESS->value
        ];

        $user->balance = $user->balance - $transfer->amount;
        $user->save();
        $balance = $user->balance;

        $transfer->status = TransferStatus::Approved->value;
        $transfer->other_status = TransferStatus::Approved->value;
        $transfer->message = 'Withdrawal approved';
        $transfer->save();

        $transactionData['current_balance'] = $balance;
        Transaction::create($transactionData);

        $notificationMessage = '' . config('app.name') . ' Acct holder:' . $user->first_name . ' ' . $user->last_name . ' ' . $transactionData['type'] . ': ' . currency($user->currency) . formatAmount($transactionData['amount']) . ' Desc:' . $transactionData['description'] . ' DT:' . $transactionData['date'] . ' Available Bal:' . currency($user->currency) . formatAmount($transactionData['current_balance']) . '' . ' Status: Successful';

        $notificationData = [
            'uuid'          => Str::uuid(),
            'type'          => $transactionData['type'],
            'notification'  => $notificationMessage,
            'user_id'       => $user->id,
        ];

        Notification::create($notificationData);
        if ($transfer->type == 'Wire Transfer') {
            // Receiver
            $receiverUser->balance += $transfer->amount;
            $receiverUser->save();

            $receiverTransactionData = [
                'uuid'          => Str::uuid(),
                'user_id'       => $receiverUser->id,
                'type'          => 'CREDIT',
                'description'   => $transfer->description,
                'amount'        => $transfer->amount,
                'current_balance' => $receiverUser->balance,
                'date'          => date('Y-m-d'),
                'time'          => date('H:i:s'),
                'reference_id'  => $transfer->reference_id,
                'status'        => TransactionStatus::SUCCESS->value
            ];

            Transaction::create($receiverTransactionData);

            $receiverNotificationMessage = 'You have received a transfer of ' . currency($receiverUser->currency) . formatAmount($receiverTransactionData['amount']) . ' from ' . $user->first_name . ' ' . $user->last_name . '. Your new balance is ' . currency($receiverUser->currency) . formatAmount($receiverTransactionData['current_balance']) . '. Thank you for using ' . config('app.name') . '.';

            $receiverNotificationData = [
                'uuid'          => Str::uuid(),
                'type'          => $receiverTransactionData['type'],
                'notification'  => $receiverNotificationMessage,
                'user_id'       => $receiverUser->id,
            ];

            Notification::create($receiverNotificationData);

            session()->forget('receiverAccountNumber');
            // Receiver End
        }
        $transaction = Transaction::where('reference_id', $transfer->reference_id)->first();

        try {
            AdminHelper::mailConfig($user->registration_token);
            Mail::to($user->email)->send(new TransferMail($user, $transfer, $transaction, 'My' . ' ' . config('app.name') . ' :: Transfer Completed' . ' ' . now()));
        } catch (\Exception $e) {
            session()->flash('email_error', $e->getMessage() . 'An error occurred while trying to send email');
        }



        return redirect()->back()->with('success', 'Withdrawal approved successfully');
    }
}
