<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\Card;
use App\Models\User;
use App\Models\Admin;
use App\Enum\CardType;
use App\Helpers\UserHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function index()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $cards = Card::where('user_id', $user->id)->latest()->get();
        $cardTypes = CardType::cases();


        $data = [
            'title' => 'Card Application',
            'user'  => $user,
            'cards' => $cards,
            'cardTypes' => $cardTypes,
            'admin' => $admin
        ];
        return view('dashboard.user.card.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'residential_address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = User::findOrFail(auth('user')->user()->id);

        $data = [
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'name' => $request->name,
            'type' => $request->type,
            'residential_address' => $request->residential_address,
            'registration_token' => $user->registration_token,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        Card::create($data);

        return redirect()->back()->with('success', 'Card request submitted successfully. Please wait for approval.');
    }
}
