<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class ResultadosEncontrados extends ReadableEnum
{
    public const PCR_POSITIVO = 'PCR positivo';
    public const PCR_NEGATIVO = 'PCR negativo';
    public const IGM_POSITIVO = 'IgM positivo';
    public const IGM_NEGATIVO = 'IgM negativo';
    public const IGG_POSITIVO = 'IgG positivo';
    public const IGG_NEGATIVO = 'IgG negativo';

    public static function values(): array
    {
        return [
            self::PCR_POSITIVO,
            self::PCR_NEGATIVO,
            self::IGM_POSITIVO,
            self::IGM_NEGATIVO,
            self::IGG_POSITIVO,
            self::IGG_NEGATIVO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::PCR_POSITIVO => 'PCR Positivo',
            self::PCR_NEGATIVO => 'PCR Negativo',
            self::IGM_POSITIVO => 'IgM Positivo',
            self::IGM_NEGATIVO => 'IgM Negativo',
            self::IGG_POSITIVO => 'IgG Positivo',
            self::IGG_NEGATIVO => 'IgG Negativo',
        ];
    }
}
