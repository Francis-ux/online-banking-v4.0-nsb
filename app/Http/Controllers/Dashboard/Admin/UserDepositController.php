<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Deposit;
use App\Trait\ImageUpload;
use App\Enum\DepositStatus;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Helpers\AdminHelper;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Enum\TransactionStatus;
use App\Http\Controllers\Controller;
use App\Mail\Deposit as DepositMail;
use Illuminate\Support\Facades\Mail;

class UserDepositController extends Controller
{
    use ImageUpload;
    public function index($uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();
        $deposits = Deposit::where('user_id', $user->id)->latest()->get();

        $data = [
            'title' => 'User Deposit',
            'user'  => $user,
            'admin' => $admin,
            'deposits' => $deposits
        ];

        return view('dashboard.admin.users.deposit.index', $data);
    }
    public function show($user, $deposit)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $user)->first();
        $deposit = Deposit::where('user_id', $user->id)->where('uuid', $deposit)->first();

        $data = [
            'title' => 'User Deposit Details',
            'user'  => $user,
            'admin' => $admin,
            'deposit' => $deposit
        ];

        return view('dashboard.admin.users.deposit.show', $data);
    }

    public function confirm($user, $deposit)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $user)->first();
        $deposit = Deposit::where('user_id', $user->id)->where('uuid', $deposit)->first();
        $deposit->status = DepositStatus::CONFIRMED->value;
        $deposit->save();
        $user->balance += $deposit->amount;
        $user->save();

        $transactionData = [
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'type' => 'CREDIT',
            'description' => $deposit->method . ' ' . 'deposit method',
            'amount' => $deposit->amount,
            'current_balance' => $user->balance,
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'reference_id' => $deposit->reference_id,
            'status' => TransactionStatus::SUCCESS->value
        ];

        try {
            AdminHelper::mailConfig($admin->registration_token);
            Mail::to($user->email)->send(new DepositMail($user, $transactionData, 'My' . ' ' . config('app.name') . ' :: Credit Transaction' . ' ' . now()));
        } catch (\Exception $e) {
            session()->flash('email_error', 'An error occurred while attempting to send the email. Please try again later.');
        }

        Transaction::create($transactionData);

        $notificationMessage = '' . config('app.name') . ' Acct holder:' . $user->first_name . ' ' . $user->last_name . ' ' . $transactionData['type'] . ': ' . currency($user->currency) . formatAmount($transactionData['amount']) . ' Desc:' . $transactionData['description'] . ' DT:' . $transactionData['date'] . ' Available Bal:' . currency($user->currency) . formatAmount($transactionData['current_balance']) . '' . ' Status: Successful';

        $notificationData = [
            'uuid'          => Str::uuid(),
            'type'          => $transactionData['type'],
            'notification'  => $notificationMessage,
            'user_id'       => $user->id,
        ];

        Notification::create($notificationData);

        return redirect()->route('admin.users.deposit.index', $user->uuid)->with('success', 'Deposit Confirmed Successfully');
    }
    public function delete($user, $deposit)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();

        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $user)->first();

        $deposit = Deposit::where('uuid', $deposit)->first();

        $this->deleteImage('uploads/users/deposit/', $deposit->proof);

        $deposit->delete();

        return redirect()->route('admin.users.deposit.index', $user->uuid)->with('success', 'Deposit Deleted Successfully');
    }
}
