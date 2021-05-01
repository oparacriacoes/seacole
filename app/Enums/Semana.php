<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class Semana extends ReadableEnum
{
    public const SEGUNDA = 'seg';
    public const TERCA = 'ter';
    public const QUARTA = 'qua';
    public const QUINTA = 'qui';
    public const SEXTA = 'sex';

    public static function values(): array
    {
        return [
            self::SEGUNDA,
            self::TERCA,
            self::QUARTA,
            self::QUINTA,
            self::SEXTA,
        ];
    }

    public static function readables(): array
    {
        return [
            self::SEGUNDA => 'Segunda',
            self::TERCA => 'Terça',
            self::QUARTA => 'Quarta',
            self::QUINTA => 'Quinta',
            self::SEXTA => 'Sexta',
        ];
    }
}
