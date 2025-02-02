<?php

namespace App\Enums;

class ConditionType
{
    public const TYPES = [
        1 => 'шт',
        2 => 'пар',
        3 => 'мл',
        4 => 'гр',
    ];

    public static function ids(): array
    {
        return array_keys(self::TYPES);
    }

    public static function getValue(int $id): ?string
    {
        return self::TYPES[$id] ?? null;
    }
}
