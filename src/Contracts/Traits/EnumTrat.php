<?php

namespace Salarmotevalli\CartWire\Contracts\Traits;

trait EnumTrait
{

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getCases()
    {
        return array_column(self::cases(), 'name');
    }

    public static function options(): array
    {
        return array_combine(self::getCases(), self::getValues());
    }

    public static function wrapOptions(): array
    {
        return array_combine(self::getValues(), self::getCases());
    }

}
