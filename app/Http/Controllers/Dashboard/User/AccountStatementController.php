<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Admin;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class AccountStatementController extends Controller
{
    public function index()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();

        $data = [
            'title' => 'Account Statement',
            'user' => $user,
            'admin' => $admin,
        ];

        return view('dashboard.user.account_statement.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from',
        ], [
            'from.required' => 'Please enter start date',
            'to.required' => 'Please enter end date',
            'to.after_or_equal' => 'Invalid date range',
        ]);

        $transactions = Transaction::whereBetween('date', [$request->from, $request->to])->get();

        if (count($transactions) > 0) {
            return redirect()->route('user.account.statement.show', [$request->from, $request->to]);
        }

        return redirect()->back()->with('error', 'No transaction found');
    }

    public function show($fromDate, $toDate)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transactions = Transaction::where('user_id', $user->id)->whereBetween('date', [$fromDate, $toDate])->paginate(10);

        $totalAmount = 0;

        foreach ($transactions as $key => $transaction) {
            $totalAmount += $transaction->amount;
        }

        $data = [
            'title' => 'Account Statement',
            'user' => $user,
            'admin' => $admin,
            'transactions' => $transactions,
            'totalAmount' => $totalAmount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ];

        return view('dashboard.user.account_statement.show', $data);
    }

    public function download($fromDate, $toDate)
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $transactions = Transaction::where('user_id', $user->id)->whereBetween('date', [$fromDate, $toDate])->paginate(10);

        $totalAmount = 0;

        foreach ($transactions as $key => $transaction) {
            $totalAmount += $transaction->amount;
        }

        $data = [
            'title' => 'Account Statement',
            'user' => $user,
            'admin' => $admin,
            'transactions' => $transactions,
            'totalAmount' => $totalAmount,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ];

        $name = config('app.name') . '-' . 'Account Statement For' . '-' . $user->first_name . ' ' . $user->last_name . '-' . now();

        // $pdf = Pdf::loadView('pdf.transaction', $data);
        $pdf = Pdf::loadView('pdf.account_statement', $data)->setPaper('A3');

        if (config('app.env') == 'production') {
            return $pdf->download($name);
        } else {
            return $pdf->stream($name);
        }
    }
}
