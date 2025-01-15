<?php

namespace App\Enum;

enum AccountState: int
{
    case Active = 1;
    case Disabled = 2;
    case Kyc = 3;
    case Frozen = 4;
}
