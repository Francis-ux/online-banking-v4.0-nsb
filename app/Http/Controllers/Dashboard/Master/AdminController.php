<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Models\Admin;
use App\Models\Master;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function create()
    {
        $data = ['title' => 'Create Admin'];
        return view('dashboard.master.admin.create', $data);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'registration_token' => 'required|unique:admins,registration_token',
            'password' => 'required',
            'dial_code' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $data['uuid'] = Str::uuid();
        $data['live_chat_id'] = Str::uuid();
        $data['password'] = Hash::make($data['password']);

        Admin::create($data);

        return redirect()->route('master.admin.edit', $data['uuid'])->with('success', 'Admin created successfully.');
    }
    public function edit($uuid)
    {
        $data = [
            'title' => 'Edit Admin',
            'admin' => Admin::where('uuid', $uuid)->first(),
        ];
        return view('dashboard.master.admin.edit', $data);
    }
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'registration_token' => 'required',
            'password' => 'nullable',
            'dial_code' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'smtp_user' => 'required',
            'smtp_password' => 'required',
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_encryption' => 'required',
            'status' => 'required',
            'live_chat' => 'nullable',
        ]);

        $admin = Admin::where('uuid', $uuid)->first();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'registration_token' => $request->registration_token,
            'status' => $request->status,
            'dial_code' => $request->dial_code,
            'phone' => $request->phone,
            'address' => $request->address,
            'live_chat' => $request->live_chat,
            'smtp_user' => $request->smtp_user,
            'smtp_password' => $request->smtp_password,
            'smtp_host' => $request->smtp_host,
            'smtp_port' => $request->smtp_port,
            'smtp_encryption' => $request->smtp_encryption,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $admin->update($data);

        return redirect()->route('master.admin.edit', $uuid)->with('success', 'Admin updated successfully.');
    }
}
