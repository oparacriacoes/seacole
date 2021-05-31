<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class RacasCores extends ReadableEnum
{
    public const PRETA = 'preta';
    public const PARDA = 'parda';
    public const BRANCA = 'branca';
    public const AMARELA = 'amarela';
    public const INDIGENA = 'indígena';


    public static function values(): array
    {
        return [
            self::PRETA,
            self::PARDA,
            self::BRANCA,
            self::AMARELA,
            self::INDIGENA,
        ];
    }

    public static function readables(): array
    {
        return [
            self::PRETA => 'Preta',
            self::PARDA => 'Parda',
            self::BRANCA => 'Branca',
            self::AMARELA => 'Amarela',
            self::INDIGENA => 'Indígena',
        ];
    }
}
