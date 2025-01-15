<?php

namespace App\Helpers;

use App\Models\User;

class UserHelper
{
    public static function isUserEmailVerified()
    {
        $user = User::findOrFail(auth('user')->user()->id);

        if ($user->email_verified_at == null) {
            return true;
        }
        return false;
    }
}
