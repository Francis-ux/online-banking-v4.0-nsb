<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Models\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $master = Master::findOrFail(auth('master')->user()->id);

        $data = [
            'title' => 'Profile',
            'master' => $master
        ];
        return view('dashboard.master.profile.index', $data);
    }

    public function update(Request $request)
    {
        $master = Master::findOrFail(auth('master')->user()->id);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $master->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
