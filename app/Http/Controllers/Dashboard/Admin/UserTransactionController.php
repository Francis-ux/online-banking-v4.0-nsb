<?php

namespace App\Http\Controllers\Dashboard\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Transfer;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Helpers\AdminHelper;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\DebitTransaction;
use App\Enum\TransactionStatus;
use App\Mail\CreditTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;


class UserTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();
        $transactions = Transaction::where('user_id', $user->id)->latest()->get();

        $data = [
            'title'         => 'User Transactions',
            'user'          => $user,
            'admin'         => $admin,
            'transactions'  => $transactions,
        ];

        return view("dashboard.admin.users.transaction.index", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $uuid)
    {
        $request->validate([
            'amount'       => 'required|numeric',
            'type'         => 'required',
            'date'         => 'required',
            'notification' => 'required',
            'description'  => 'required',
        ]);

        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();

        $referenceId = rand(55555555, 999999999);
        $balance     = $user->balance;
        $amount      = $request->amount;


        $transactionData = [
            'uuid'          => Str::uuid(),
            'user_id'       => $user->id,
            'type'          => $request->type,
            'description'   => $request->description,
            'amount'        => $amount,
            'date'          => $request->date,
            'time'          => date('H:i:s'),
            'reference_id'  => $referenceId,
            'status'        => TransactionStatus::SUCCESS->value
        ];

        AdminHelper::mailConfig($admin->registration_token);

        switch ($request->type) {
            case 'CREDIT':
                $user->balance = $balance + $amount;
                $user->save();

                $balance += $amount;

                switch ($request->notification) {
                    case 'EMAIL':
                        try {
                            Mail::to($user->email)->send(new CreditTransaction($user, $transactionData, 'My' . ' ' . config('app.name') . ' :: Credit Transaction' . ' ' . now()));
                        } catch (\Exception $e) {
                            session()->flash('email_error', 'An error occurred while attempting to send the email. Please try again later.');
                        }
                        break;
                }
                break;
            case 'DEBIT':
                if ($amount > $balance) {
                    session()->flash('error', 'Transaction failed insufficient balance');
                    return redirect()->back();
                }

                $user->balance = $balance - $amount;
                $user->save();

                $balance -= $amount;

                switch ($request->notification) {
                    case 'EMAIL':
                        try {
                            Mail::to($user->email)->send(new DebitTransaction($user, $transactionData, 'My' . ' ' . config('app.name') . ' :: Debit Transaction' . ' ' . now()));
                        } catch (\Exception $e) {
                            session()->flash('email_error', 'An error occurred while attempting to send the email. Please try again later.');
                        }
                        break;
                }
                break;
        }

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

        return redirect()->back()->with('success', 'Transaction successful');
    }

    public function delete(string $uuid)
    {
        $transaction = Transaction::where('uuid', $uuid)->first();

        $transaction->delete();

        return redirect()->back()->with('success', 'Transaction deleted successfully');
    }
    public function print($user,$transaction)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $user)->first();

        $transaction = Transaction::where('uuid', $transaction)->first();
        $transfer = Transfer::where('user_id', $user->id)->where('reference_id', $transaction->reference_id)->first();

        $data = [
            'user'  => $user,
            'transaction' => $transaction,
            'transfer' => $transfer,
            'admin' => $admin
        ];

        $name = config('app.name') . '-' . 'Transaction Receipt For' . '-' . $user->first_name . ' ' . $user->last_name . '-' . now();

        // $pdf = Pdf::loadView('pdf.transaction', $data);
        $pdf = Pdf::loadView('pdf.transaction_3', $data);

        if (config('app.env') == 'production') {
            return $pdf->download($name);
        } else {
            return $pdf->stream($name);
        }
    }
}
