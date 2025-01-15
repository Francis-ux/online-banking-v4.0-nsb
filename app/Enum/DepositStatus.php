<?php

namespace App\Enum;

enum DepositStatus: int
{
    case PENDING = 0;
    case CONFIRMED = 1;
}
