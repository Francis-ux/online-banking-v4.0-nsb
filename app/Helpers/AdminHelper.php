<?php

namespace App\Helpers;

use App\Models\Admin;

class AdminHelper
{
    public static function mailConfig($registrationToken)
    {
        $admin = Admin::where('registration_token', $registrationToken)->first();

        if ($admin) {
            $config = [
                'transport'     => 'smtp',
                'host'          => @$admin->smtp_host,
                'port'          => @$admin->smtp_port,
                'encryption'    => @$admin->smtp_encryption,
                'username'      => @$admin->smtp_user,
                'password'      => @$admin->smtp_password,
                'timeout'       => null,
                'local_domain'  => env('MAIL_EHLO_DOMAIN'),
            ];

            config(['mail.mailers.smtp' => $config]);
            config(['mail.from.address' => @$admin->email]);
        }
    }
}
