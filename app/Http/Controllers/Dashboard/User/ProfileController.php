<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Admin;
use App\Enum\AccountState;
use App\Trait\ImageUpload;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    use ImageUpload;
    public function index()
    {
        if (UserHelper::isUserEmailVerified()) {
            return redirect()->route('user.email.verification')->with('error', 'Unable to verify the authenticity of this account, Please enter verification code sent to your email at the time of registration');
        }

        $user = User::findOrFail(auth('user')->user()->id);
        $admin = Admin::where('registration_token', $user->registration_token)->first();
        $accountStates = AccountState::cases();

        $data = [
            'title' => 'Profile',
            'user'  => $user,
            'accountStates' => $accountStates,
            'admin' => $admin
        ];
        return view('dashboard.user.profile.index', $data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'gender' => 'required',
            'marital_status' => 'required',
            'dial_code' => 'required',
            'phone' => 'required',
            'professional_status' => 'required',
            'transfer_pin' => 'nullable',
            'address' => 'required',
            'nationality' => 'required',
        ]);

        $user = User::findOrFail(auth('user')->user()->id);

        $data = [
            'gender' => $request->gender,
            'marital_status' => $request->marital_status,
            'dial_code' => $request->dial_code,
            'phone' => $request->phone,
            'professional_status' => $request->professional_status,
            'transfer_pin' => $request->transfer_pin ?? $user->transfer_pin,
            'address' => $request->address,
            'nationality' => $request->nationality
        ];

        $user->update($data);

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
    public function uploadFrontId(Request $request)
    {
        $request->validate([
            'id_front' => 'required|image'
        ]);

        $user = User::findOrFail(auth('user')->user()->id);
        $user->id_front = $this->imageInterventionUpdateImage($request, 'id_front', 'uploads/users/id/', 1012, 638, $user?->id_front);
        $user->save();

        return redirect()->back()->with('success', 'Front ID Uploaded Successfully');
    }
    public function uploadBackId(Request $request)
    {
        $request->validate([
            'id_back' => 'required|image'
        ]);

        $user = User::findOrFail(auth('user')->user()->id);
        $user->id_back = $this->imageInterventionUpdateImage($request, 'id_back', 'uploads/users/id/', 1012, 638, $user?->id_back);
        $user->save();

        return redirect()->back()->with('success', 'Back ID Uploaded Successfully');
    }
    public function requestValidation()
    {
        $user = User::findOrFail(auth('user')->user()->id);

        if ($user->id_front == null || $user->id_back == null) {
            return redirect()->back()->with('error', 'Please upload your ID first');
        }

        if ($user->request_validation == 0) {
            $user->request_validation = 1;
            $user->save();

            return redirect()->back()->with('success', 'Validation Request Sent Successfully');
        } else {
            return redirect()->back()->with('error', 'Validation Request Already Sent');
        }
    }

    public function updateImage(Request $request)
    {

        $request->validate([
            'image' => 'required|image'
        ]);

        $user = User::findOrFail(auth('user')->user()->id);
        $user->image = $this->imageInterventionUpdateImage($request, 'image', 'uploads/users/image/', 400, 400, $user?->image);
        $user->save();

        return redirect()->back()->with('success', 'Profile Picture Uploaded Successfully');
    }
}
