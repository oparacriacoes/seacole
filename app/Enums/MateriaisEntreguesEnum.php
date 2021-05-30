<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

class MateriaisEntreguesEnum extends ReadableEnum
{
    public const CARTILHA = 'cartilha-cuidados';
    public const TERMOMETRO = 'termometro';
    public const DIPIRONA = 'dipirona';
    public const PARACETAMOL = 'paracetamol';
    public const OXIMETRO = 'oximetro';
    public const MASCARAS_TECIDO = 'mascaras-tecido';
    public const MATERIAL_LIMPEZA = 'material-limpeza';
    public const CESTA_BASICA = 'cesta-basica';


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
