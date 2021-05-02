<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;
use Illuminate\Support\Str;

final class ChartsEnum extends ReadableEnum
{
    public const CASOS_MONITORADOS = 'novos-casos-monitorados';
    public const MONITORADOS_EXCLUSIVO_PSICOLOGIA = 'monitorados-exclusivo-psicologia';


    public static function values(): array
    {
        return [
            self::CASOS_MONITORADOS,
            self::MONITORADOS_EXCLUSIVO_PSICOLOGIA,
        ];
    }

    public static function readables(): array
    {
        return [
            self::CASOS_MONITORADOS => Str::title('NOVOS CASOS MONITORADOS'),
            self::MONITORADOS_EXCLUSIVO_PSICOLOGIA => Str::title('MONITORADOS X EXCLUSIVO PSICOLOGIA'),
        ];
    }
}
