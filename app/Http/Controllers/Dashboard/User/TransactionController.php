<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Admin;
use App\Models\Transfer;
use App\Helpers\UserHelper;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transactions = Transaction::where('user_id', $user->id)->latest()->get();

        $data = [
            'title' => 'User transactions',
            'user'  => $user,
            'transactions' => $transactions,
            'admin' => $admin
        ];

        return view('dashboard.user.transaction.index', $data);
    }
    public function show(string $uuid)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transaction = Transaction::where('uuid', $uuid)->first();
        $transfer = Transfer::where('user_id', $user->id)->where('reference_id', $transaction->reference_id)->first();

        $data = [
            'title' => 'User transactions',
            'user'  => $user,
            'transaction' => $transaction,
            'transfer' => $transfer,
            'admin' => $admin
        ];

        return view('dashboard.user.transaction.show', $data);
    }
    public function print($uuid)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transaction = Transaction::where('uuid', $uuid)->first();
        $transfer = Transfer::where('user_id', $user->id)->where('reference_id', $transaction->reference_id)->first();

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
