<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

class MateriaisEntreguesEnum extends ReadableEnum
{
    public const CARTILHA = 'Cartilha de cuidados';
    public const TERMOMETRO = 'Termometro';
    public const DIPIRONA = 'Dipirona';
    public const PARACETAMOL = 'Paracetamol';
    public const OXIMETRO = 'Oximetro';
    public const MASCARAS_TECIDO = 'Mascaras de tecido';
    public const MATERIAL_LIMPEZA = 'Material de limpeza';
    public const CESTA_BASICA = 'Cesta basica';


    public static function values(): array
    {
        return [
            self::CARTILHA,
            self::TERMOMETRO,
            self::DIPIRONA,
            self::PARACETAMOL,
            self::OXIMETRO,
            self::MASCARAS_TECIDO,
            self::MATERIAL_LIMPEZA,
            self::CESTA_BASICA,
        ];
    }

    public static function readables(): array
    {
        return [
            self::CARTILHA => 'Cartilha de Cuidados',
            self::TERMOMETRO => 'Termômetro',
            self::DIPIRONA => 'Dipirona',
            self::PARACETAMOL => 'Paracetamol',
            self::OXIMETRO => 'Oxímetro',
            self::MASCARAS_TECIDO => 'Máscaras de Tecido',
            self::MATERIAL_LIMPEZA => 'Material de Limpeza',
            self::CESTA_BASICA => 'Cesta Básica',
        ];
    }
}
