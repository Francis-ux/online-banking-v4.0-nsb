<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Admin;
use App\Helpers\UserHelper;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $notifications = Notification::where('user_id', $user->id)->latest()->get();

        $data = [
            'title' => 'Notification',
            'user'  => $user,
            'notifications' => $notifications,
            'admin' => $admin
        ];

        return view('dashboard.user.notification.index', $data);
    }
}
