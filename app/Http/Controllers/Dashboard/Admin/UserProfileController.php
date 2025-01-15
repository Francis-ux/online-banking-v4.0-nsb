<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Enum\AccountState;
use App\Trait\ImageUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    use ImageUpload;
    public function index(string $uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();
        $accountStates = AccountState::cases();

        $data = [
            'title' => 'Profile',
            'admin' => $admin,
            'user'  => $user,
            'accountStates' => $accountStates
        ];

        return view('dashboard.admin.users.profile.index', $data);
    }

    public function update(Request $request, $uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $data = $request->validate([
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => ['email', 'unique:users,email,' . $user->id],
            'password' => 'nullable|min:8',
            'dob' => 'date',
            'gender' => 'string',
            'marital_status' => 'string',
            'dial_code' => 'string',
            'phone' => 'string',
            'professional_status' => 'string|max:255',
            'should_login_require_code' => 'required',
            'should_transfer_fail' => 'required',
            'created_at' => 'date',
            'address' => 'string|max:255',
            'nationality' => 'string',
            'currency' => 'string',
            'account_type' => 'string',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $data['password_text'] = $request->password;
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.profile.index', $uuid)->with('success', 'User updated successfully.');
    }
    public function delete($uuid)
    {
        $user = User::where('uuid', $uuid)->first();

        $this->deleteImage('uploads/users/image/', $user->image);
        $this->deleteImage('uploads/users/id/', $user->id_front);
        $this->deleteImage('uploads/users/id/', $user->id_back);

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }
}
