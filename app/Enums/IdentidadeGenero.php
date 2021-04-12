<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class IdentidadeGenero extends ReadableEnum
{
    public const MULHER_CIS = 'mulher cis';
    public const MULHER_TRANS = 'mulher trans';
    public const HOMEM_CIS = 'homem cis';
    public const HOMEM_TRANS = 'homem trans';
    public const NAO_BINARIO = 'nao binario';
    public const OUTRO = 'outro';


    public static function values(): array
    {
        return [
            self::MULHER_CIS,
            self::MULHER_TRANS,
            self::HOMEM_CIS,
            self::HOMEM_TRANS,
            self::NAO_BINARIO,
            self::OUTRO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::MULHER_CIS => 'Mulher Cis',
            self::MULHER_TRANS => 'Mulher Trans',
            self::HOMEM_CIS => 'Homem Cis',
            self::HOMEM_TRANS => 'Homem Trans',
            self::NAO_BINARIO => 'Não Binário',
            self::OUTRO => 'Outro',
        ];
    }
}
