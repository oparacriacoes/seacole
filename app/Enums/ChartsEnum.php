<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;
use Illuminate\Support\Str;

final class ChartsEnum extends ReadableEnum
{
    public const CASOS_MONITORADOS = '1';


    public static function values(): array
    {
        return [
            self::CASOS_MONITORADOS,
        ];
    }

    public static function readables(): array
    {
        return [
            self::CASOS_MONITORADOS => Str::title('NOVOS CASOS MONITORADOS'),
        ];
    }
}
