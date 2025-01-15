<?php

namespace App\Enum;

enum CardType: int
{
    case CREDIT = 1;
    case DEBIT = 2;
    case VIRTUAL = 3;
}
