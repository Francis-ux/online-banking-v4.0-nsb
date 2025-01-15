<?php

namespace App\Enum;

enum IsAccountVerified: int
{
    case VERIFIED = 1;
    case UNVERIFIED = 0;
}
