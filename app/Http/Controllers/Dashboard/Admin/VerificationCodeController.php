<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VerificationCode;
use App\Http\Controllers\Controller;

class VerificationCodeController extends Controller
{
    public function index()
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $verificationCodes = VerificationCode::where('registration_token', $admin->registration_token)->latest()->get();
        $users = User::where('registration_token', $admin->registration_token)->latest()->get();

        $data = [
            'title' => 'Registered codes',
            'verificationCodes' => $verificationCodes,
            'users' => $users,
            'admin' => $admin
        ];

        return view('dashboard.admin.verification_code.index', $data);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => ['required'],
            'description'    => ['required'],
            'length'         => ['required', 'numeric'],
            'nature_of_code' => ['required'],
            'applicable_to'  => ['required']
        ]);
        $data['uuid'] = Str::uuid();
        $data['registration_token'] = auth('admin')->user()->registration_token;

        VerificationCode::create($data);

        return redirect()->back()->with('success', 'Verification code created successfully');
    }
    public function edit(string $uuid)
    {
        $verificationCode = VerificationCode::where('uuid', $uuid)->first();
        $verificationCodes = VerificationCode::latest()->get();
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $users = User::where('registration_token', $admin->registration_token)->latest()->get();

        $data = [
            'title' => 'Registered codes',
            'verificationCode' => $verificationCode,
            'users' => $users,
            'admin' => $admin,
            'verificationCodes' => $verificationCodes
        ];

        return view('dashboard.admin.verification_code.edit', $data);
    }
    public function update(Request $request, string $uuid)
    {
        $data = $request->validate([
            'name'           => ['required'],
            'description'    => ['required'],
            'length'         => ['required', 'numeric'],
            'nature_of_code' => ['required'],
            'applicable_to'  => ['required']
        ]);

        $verificationCode = VerificationCode::where('uuid', $uuid)->first();

        $verificationCode->update($data);

        return redirect()->route('admin.verification.code.index')->with('success', 'Verification code updated successfully');
    }
    public function delete(string $uuid)
    {
        $verificationCode = VerificationCode::where('uuid', $uuid)->first();

        $verificationCode->delete();

        return redirect()->back()->with('success', 'Verification code deleted successfully');
    }
}
