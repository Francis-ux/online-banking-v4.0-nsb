<?php

namespace App\Enum;

enum ShouldLoginRequireCode: int
{
    case YES = 1;
    case NO = 0;
}
