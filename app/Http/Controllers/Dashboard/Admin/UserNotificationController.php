<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Helpers\AdminHelper;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notification as NotificationMail;

class UserNotificationController extends Controller
{
    public function index($uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $user = User::where('registration_token', $admin->registration_token)->where('uuid', $uuid)->first();
        $notifications = Notification::where('user_id', $user->id)->orderBy('id', 'desc')->get();

        $data = [
            'title' => 'User notifications',
            'user'  => $user,
            'notifications' => $notifications,
            'admin' => $admin
        ];

        return view('dashboard.admin.users.notification.index', $data);
    }

    public function send(Request $request, $uuid)
    {
        $request->validate([
            'title'      => 'required',
            'message'    => 'required',
            'notifiable' => 'required',
        ]);

        $user = User::where('uuid', $uuid)->first();

        $data = [
            'uuid'          => Str::uuid(),
            'type'          => $request->title,
            'notification'  => $request->message,
            'user_id'       => $user->id,
        ];

        Notification::create($data);

        switch ($request->notifiable) {
            case 'EMAIL':
                try {
                    AdminHelper::mailConfig($user->registration_token);
                    Mail::to($user->email)->send(new NotificationMail($user, $data, 'My' . ' ' . config('app.name') . ' :: ' . $request->title . '' . ' ' . now()));
                } catch (\Exception $e) {
                    session()->flash('email_error', 'An error occurred while attempting to send the email. Please try again later.');
                }
                break;
        }

        return redirect()->back()->with('success', 'Notification sent successfully');
    }

    public function delete($uuid)
    {
        $notification = Notification::where('uuid', $uuid)->first();
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully');
    }
}
