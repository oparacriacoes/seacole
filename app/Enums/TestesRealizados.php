<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class TestesRealizados extends ReadableEnum
{
    public const PCR = 'pcr';
    public const SOROLOGIA = 'sorologias';
    public const TESTE_RAPIDO = 'teste-rapido';
    public const NAO_INFORMADO = 'nao-informado';


    public static function values(): array
    {
        return [
            self::PCR,
            self::SOROLOGIA,
            self::TESTE_RAPIDO,
            self::NAO_INFORMADO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::PCR => 'PCR',
            self::SOROLOGIA => 'Sorologias (IgM/IgG)',
            self::TESTE_RAPIDO => 'Teste Rápido',
            self::NAO_INFORMADO => 'Não Informado',
        ];
    }
}
