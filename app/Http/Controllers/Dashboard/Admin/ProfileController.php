<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Trait\ImageUpload;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    use ImageUpload;
    public function index()
    {
        $admin = Admin::findOrFail(auth('admin')->user()->id);

        $data = [
            'title' => 'Profile',
            'admin' => $admin,
        ];

        return view('dashboard.admin.profile.index', $data);
    }

    public function update(Request $request, $uuid)
    {
        $admin = Admin::where('uuid', $uuid)->firstOrFail();

        $data = $request->validate([
            'btc_address' => 'string|max:255',
            'btc_qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['btc_qr_code'] =  $this->imageInterventionUpdateImage($request, 'btc_qr_code', 'uploads/admin/bitcoin_qr_code/', 600, 600, $admin?->btc_qr_code);

        $admin->update($data);

        return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully.');
    }
}
