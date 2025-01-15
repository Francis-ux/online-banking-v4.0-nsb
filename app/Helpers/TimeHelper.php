<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimeHelper
{
    public static function getTimeOfDay()
    {
        $currentHour = Carbon::now()->hour;

        if ($currentHour >= 5 && $currentHour < 12) {
            return 'morning';
        } elseif ($currentHour >= 12 && $currentHour < 17) {
            return 'afternoon';
        } elseif ($currentHour >= 17 && $currentHour < 21) {
            return 'evening';
        } else {
            return 'night';
        }
    }
}
