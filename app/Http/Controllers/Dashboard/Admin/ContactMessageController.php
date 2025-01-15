<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactMessageController extends Controller
{
    public function index()
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $contactMessages = Contact::latest()->get();

        $data = [
            'title' => 'Contact Messages',
            'admin' => $admin,
            'contactMessages' => $contactMessages
        ];

        return view('dashboard.admin.contact_message.index', $data);
    }
    public function show($uuid)
    {
        $admin = Admin::where('registration_token', auth('admin')->user()->registration_token)->first();
        $contactMessage = Contact::where('uuid', $uuid)->first();

        $data = [
            'title' => 'Contact Message Details',
            'admin' => $admin,
            'contactMessage' => $contactMessage
        ];

        return view('dashboard.admin.contact_message.show', $data);
    }
    public function delete($uuid)
    {
        $contactMessage = Contact::where('uuid', $uuid)->first();

        $contactMessage->delete();

        return redirect()->route('admin.contact.message.index')->with('success', 'Contact Message Deleted Successfully');
    }
}
