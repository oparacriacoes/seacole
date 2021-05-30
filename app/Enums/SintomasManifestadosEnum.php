<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class SintomasManifestadosEnum extends ReadableEnum
{
    public const TOSSE = 'tosse';
    public const FALTA_AR = 'falta-ar';
    public const FEBRE = 'febre';
    public const DOR_CABECA = 'dor-cabeca';
    public const PERDA_OLFATO = 'perda-olfato';
    public const PERDA_PALADAR = 'perda-paladar';
    public const ENJOO = 'enjoo';
    public const DIARREIA = 'diarreia';
    public const AUMENTO_PRESSAO = 'aumento-pressao';
    public const QUEDA_PRESSAO = 'queda-brusca-pressao';
    public const PRESSAO_BAIXA = 'pressao-baixa';
    public const SONOLENCIA = 'sonolencia';
    public const CONFUSAO_MENTAL = 'confusao-mental';
    public const DESMAIO = 'desmaio';
    public const CONVULSAO = 'convulsao';
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
            self::ENJOO,
            self::DIARREIA,
            self::AUMENTO_PRESSAO,
            self::QUEDA_PRESSAO,
            self::PRESSAO_BAIXA,
            self::SONOLENCIA,
            self::CONFUSAO_MENTAL,
            self::DESMAIO,
            self::CONVULSAO,
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
            self::ENJOO => 'Enjoo ou vômitos',
            self::DIARREIA => 'Diarréia',
            self::AUMENTO_PRESSAO => 'Aumento da pressão',
            self::QUEDA_PRESSAO => 'Queda brusca de Pressão',
            self::PRESSAO_BAIXA => 'Dor torácica (dor no peito)',
            self::SONOLENCIA => 'Sonolência ou cansaço importantes',
            self::CONFUSAO_MENTAL => 'Confusão mental',
            self::DESMAIO => 'Desmaio',
            self::CONVULSAO => 'Convulsão',
            self::OUTRO => 'Outros',
        ];
    }
}
