<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class SintomasIniciais extends ReadableEnum
{
    public const SUSPEITO = 'suspeito';
    public const CONFIRMADO = 'confirmado';
    public const DESCARTADO = 'descartado';

    public static function values(): array
    {
        return [
            self::SUSPEITO,
            self::CONFIRMADO,
            self::DESCARTADO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::SUSPEITO => 'Suspeito',
            self::CONFIRMADO => 'Confirmado',
            self::DESCARTADO => 'Descartado',
        ];
    }
}
