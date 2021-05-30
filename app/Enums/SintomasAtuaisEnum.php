<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class SintomasAtuaisEnum extends ReadableEnum
{
    public const TOSSE = 'tosse';
    public const FALTA_AR = 'falta-ar';
    public const FEBRE = 'febre';
    public const DOR_CABECA = 'dor-cabeça';
    public const PERDA_OLFATO = 'perda-olfato';
    public const PERDA_PALADAR = 'perda-paladar';
    public const OUTRO = 'outros';

    public static function values(): array
    {
        return [
            self::TOSSE,
            self::FALTA_AR,
            self::FEBRE,
            self::DOR_CABECA,
            self::PERDA_PALADAR,
            self::PERDA_OLFATO,
            self::OUTRO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::TOSSE => 'Tosse',
            self::FALTA_AR => 'Falta de ar',
            self::FEBRE => 'Febre',
            self::DOR_CABECA => 'Dor de Cabeça',
            self::PERDA_PALADAR => 'Perda do olfato',
            self::PERDA_OLFATO => 'Perda do paladar',
            self::OUTRO => 'Outros',
        ];
    }
}
