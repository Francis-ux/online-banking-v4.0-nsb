<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $users = User::where('registration_token', $admin->registration_token)->latest()->get();

        $data = [
            'title' => 'Welcome' . ' ' . auth('admin')->user()->name . ' ' . 'Administrator',
            'admin' => $admin,
            'users' => $users,
        ];

        return view('dashboard.admin.dashboard', $data);
    }
}
