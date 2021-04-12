<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class AcompanhamentoPsicologico extends ReadableEnum
{
    public const INDIVIDUAL = 'individual';
    public const EM_GRUPO = 'em grupo';

    public static function values(): array
    {
        return [
            self::INDIVIDUAL,
            self::EM_GRUPO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::INDIVIDUAL => 'Individual',
            self::EM_GRUPO => 'Em grupo',
        ];
    }
}
