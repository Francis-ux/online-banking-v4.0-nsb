<?php

namespace App\Rules;

use App\Models\Admin;
use Closure;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidReferenceId implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Admin::where('registration_token', $value)->exists() ? true : $fail('The registration token is invalid.');

        $registrationTokenExists = Admin::where('registration_token', $value)->first();

        if (!$registrationTokenExists) {
            $fail('The reference id is invalid.');
        }
    }
}
