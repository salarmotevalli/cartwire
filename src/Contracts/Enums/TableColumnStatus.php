<?php

namespace Salarmotevalli\CartWire\Contracts\Enums;

use Salarmotevalli\CartWire\Contracts\Traits\EnumTrait;

enum TableColumnStatus: int {

    use EnumTrait;

    case NULLABLE = 0;
    case REQUIRED = 1;
    
}