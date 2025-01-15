<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Admin;
use App\Models\Transfer;
use App\Helpers\UserHelper;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Enum\TransferStatus;
use App\Helpers\AdminHelper;
use App\Models\Notification;
use App\Models\TransferCode;
use Illuminate\Http\Request;
use App\Enum\TransactionStatus;
use App\Enum\ShouldTransferFail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Transfer as TransferMail;
use Barryvdh\DomPDF\Facade\Pdf;


class TransferController extends Controller
{
    public function index()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transfers = Transfer::where('user_id', $user->id)->latest()->get();

        $data = [
            'title'     => 'User transfers',
            'user'      => $user,
            'transfers' => $transfers,
            'admin'     => $admin
        ];

        return view('dashboard.user.transfer.index', $data);
    }
    public function transferFund()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $data = [
            'title' => 'Transfer funds',
            'user'  => $user,
            'admin' => $admin
        ];

        return view('dashboard.user.transfer.transfer_fund', $data);
    }
    public function preview($referenceId)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transfer = Transfer::where('reference_id', $referenceId)->first();

        $transferNeedVerificationCode = TransferCode::where('transfer_reference_id', $referenceId)->where('user_id', $user->id)->first();

        $data = [
            'title'    => 'User transfer preview',
            'user'     => $user,
            'transfer' => $transfer,
            'transferNeedVerificationCode' => $transferNeedVerificationCode,
            'admin'    => $admin
        ];

        return view('dashboard.user.transfer.preview', $data);
    }
    public function show($referenceId)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transfer = Transfer::where('reference_id', $referenceId)->first();

        $data = [
            'title'     => 'User transfer details',
            'user'      => $user,
            'transfer'  => $transfer,
            'admin'     => $admin
        ];

        return view('dashboard.user.transfer.show', $data);
    }
    public function confirm($referenceId)
    {
        $user = User::findOrFail(auth('user')->user()->id);

        $transfer = Transfer::where('reference_id', $referenceId)->first();

        $description = '';

        if ($transfer->type == "Electronic Transfer") {
            $description = 'Electronic TF: ' . $transfer->withdrawal_method . '/';
        } else {
            $description = 'Direct TF: ' . $transfer->bank_name . '/' . $transfer->account_name;
        }

        if ($user->should_transfer_fail == ShouldTransferFail::No->value) {
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

            $transaction = Transaction::where('reference_id', $transfer->reference_id)->first();

            try {
                AdminHelper::mailConfig($user->registration_token);
                Mail::to($user->email)->send(new TransferMail($user, $transfer, $transaction, 'My' . ' ' . config('app.name') . ' :: Transfer Completed' . ' ' . now()));
            } catch (\Exception $e) {
                session()->flash('email_error', $e->getMessage() . 'An error occurred while trying to send email');
            }

            return redirect()->route('user.transfer.show', $referenceId)->with('success', 'Transfer completed successfully');
        } else {
            $transactionData = [
                'uuid'          => Str::uuid(),
                'user_id'       => $user->id,
                'type'          => 'DEBIT',
                'description'   => $transfer->description ?? $description,
                'amount'        => $transfer->amount,
                'date'          => date('Y-m-d'),
                'time'          => date('H:i:s'),
                'reference_id'  => $transfer->reference_id,
                'status'        => TransactionStatus::FAILED->value
            ];

            $balance = $user->balance;

            $transfer->status = TransferStatus::Failed->value;
            $transfer->save();

            $transactionData['current_balance'] = $balance;
            Transaction::create($transactionData);

            $notificationMessage = '' . config('app.name') . ' Acct holder:' . $user->first_name . ' ' . $user->last_name . ' ' . $transactionData['type'] . ': ' . currency($user->currency) . formatAmount($transactionData['amount']) . ' Desc:' . $transactionData['description'] . ' DT:' . $transactionData['date'] . ' Available Bal:' . currency($user->currency) . formatAmount($transactionData['current_balance']) . '' . ' Status: Failed';

            $notificationData = [
                'uuid'          => Str::uuid(),
                'type'          => $transactionData['type'],
                'notification'  => $notificationMessage,
                'user_id'       => $user->id,
            ];

            Notification::create($notificationData);

            return redirect()->route('user.transfer.show', $referenceId)->with('error', 'Sorry we were unable to complete this transaction at the moment please try again later');
        }
    }

    public function process($referenceId, $orderNo)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transfer = Transfer::where('reference_id', $referenceId)->first();

        $transferCode = new TransferCode();

        $data = [
            'title'         => 'User transfer process',
            'user'          => $user,
            'transfer'      => $transfer,
            'transferCodes' => $transferCode->getTransferVerificationData($transfer->reference_id),
            'referenceId'   => $referenceId,
            'orderNo'       => $orderNo,
            'admin'         => $admin
        ];

        return view('dashboard.user.transfer.process', $data);
    }

    public function print($uuid)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transfer = Transfer::where('user_id', $user->id)->where('uuid', $uuid)->first();
        $transaction = Transaction::where('reference_id', $transfer->reference_id)->first();

        $data = [
            'user'  => $user,
            'transaction' => $transaction,
            'transfer' => $transfer,
            'admin' => $admin
        ];

        $name = config('app.name') . '-' . 'Transaction Receipt For' . '-' . $user->first_name . ' ' . $user->last_name . '-' . now();

        // $pdf = Pdf::loadView('pdf.transaction', $data);
        $pdf = Pdf::loadView('pdf.transaction_2', $data);

        if (config('app.env') == 'production') {
            return $pdf->download($name);
        } else {
            return $pdf->stream($name);
        }
    }
}
