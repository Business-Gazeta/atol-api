<?php

namespace BusinessGazeta\AtolApi\Enum\Sell;

trait EnumListTrait
{
    public static function list(): array
    {
        $items = [];
        foreach (self::cases() as $case) {
            $items[$case->value] = $case->name;
        }
        return $items;
    }
}
