<?php

namespace Cartwire\Core\Enums;

use Cartwire\Core\Traits\EnumTrait;

enum TableColumnStatus: int
{
    use EnumTrait;

    case NULLABLE = 0;
    case REQUIRED = 1;
}
