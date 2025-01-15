<?php

namespace App\Enum;

enum TransactionStatus: int
{
    case SUCCESS = 1;
    case FAILED = 2;
}
