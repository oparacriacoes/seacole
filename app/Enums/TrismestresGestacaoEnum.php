<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class TrismestresGestacaoEnum extends ReadableEnum
{
    public const TRIMESTRE_1 = '1o trimestre';
    public const TRIMESTRE_2 = '2o trimestre';
    public const TRIMESTRE_3 = '3o trimestre';


    public static function values(): array
    {
        return [
            self::TRIMESTRE_1,
            self::TRIMESTRE_2,
            self::TRIMESTRE_3,
        ];
    }

    public static function readables(): array
    {
        return [
            self::TRIMESTRE_1 => '1º Semestre',
            self::TRIMESTRE_2 => '2º Semestre',
            self::TRIMESTRE_3 => '3º Semestre',
        ];
    }
}
