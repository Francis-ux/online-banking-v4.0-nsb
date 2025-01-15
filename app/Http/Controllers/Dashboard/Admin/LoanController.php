<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Loan;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
    public function index()
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $loans = Loan::where('reference_id', $admin->registration_token)->latest()->get();

        $data = [
            'title' => 'Loans',
            'loans' => $loans,
            'admin' => $admin
        ];
        return view('dashboard.admin.loan.index', $data);
    }
    public function show($uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $loan = Loan::where('uuid', $uuid)->first();

        $data = [
            'title' => 'Loans',
            'loan' => $loan,
            'admin' => $admin
        ];
        return view('dashboard.admin.loan.show', $data);
    }
    public function delete($uuid)
    {

        $loan = Loan::where('uuid', $uuid)->first();

        $loan->delete();

        return redirect()->route('admin.loan.index')->with('success', 'Loan deleted successfully');
    }
}
