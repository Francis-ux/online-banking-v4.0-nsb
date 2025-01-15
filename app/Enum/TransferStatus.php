<?php

namespace App\Enum;

enum TransferStatus: int
{
    case Pending = 0;
    case Approved = 1;
    case Failed = 2;
}
