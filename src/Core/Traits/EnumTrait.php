<?php

namespace Cartwire\Core\Traits;

trait EnumTrait
{
    /**
     * @return array
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return array
     */
    public static function getCases(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @return array
     */
    public static function options(): array
    {
        return array_combine(self::getCases(), self::getValues());
    }

    /**
     * @return array
     */
    public static function wrapOptions(): array
    {
        return array_combine(self::getValues(), self::getCases());
    }
}
