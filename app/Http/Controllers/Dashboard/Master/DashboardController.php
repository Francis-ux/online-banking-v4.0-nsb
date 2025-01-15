<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = [
            'title' => 'Registered Admins',
            'admins' => Admin::latest()->get()
        ];
        return view('dashboard.master.dashboard', $data);
    }
}
