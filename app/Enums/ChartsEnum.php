<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;
use Illuminate\Support\Str;

final class ChartsEnum extends ReadableEnum
{
    public const CASOS_MONITORADOS = 'novos-casos-monitorados';
    public const MONITORADOS_EXCLUSIVO_PSICOLOGIA = 'monitorados-exclusivo-psicologia';
    public const SITUACAO_TOTAL_CASOS_MONITORADOS_BAR = 'situacao-total-casos-monitorados-bar';
    public const SITUACAO_TOTAL_CASOS_MONITORADOS_PIE = 'situacao-total-casos-monitorados-pie';
    public const CASOS_MONITORADOS_CIDADE = 'casos-monitorado-cidade';




    public static function values(): array
    {
        return [
            self::CASOS_MONITORADOS,
            self::MONITORADOS_EXCLUSIVO_PSICOLOGIA,
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_BAR,
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_PIE,
            self::CASOS_MONITORADOS_CIDADE,
        ];
    }

    public static function readables(): array
    {
        return [
            self::CASOS_MONITORADOS => Str::title('NOVOS CASOS MONITORADOS'),
            self::MONITORADOS_EXCLUSIVO_PSICOLOGIA => Str::title('MONITORADOS X EXCLUSIVO PSICOLOGIA'),
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_BAR => Str::title('SITUAÇÃO TOTAL DE CASOS MONITORADOS - Barras'),
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_PIE => Str::title('SITUAÇÃO TOTAL DE CASOS MONITORADOS - Pizza'),
            self::CASOS_MONITORADOS_CIDADE => Str::title('CASOS MONITORADOS POR CIDADE')
        ];
    }
}
