<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class SequelasEnum extends ReadableEnum
{
    public const PERDA_OLFATO = 'perda-persistente-olfato';
    public const PERDA_PALADAR = 'perda-persistente-paladar';
    public const TOSSE_PERSISTENTE = 'tosse-persistente';
    public const FALTA_AR_PERSISTENTE = 'falta-ar-persistente';
    public const DOR_CABECA_PESISTENTE = 'dor-cabeca-persistente';
    public const EVENTOS_TROMBOLITICOS = 'eventos-tromboliticos';
    public const DANOS_RENAIS = 'danos-renais';
    public const OUTROS = 'outros?';



    public static function values(): array
    {
        return [
            self::PERDA_OLFATO,
            self::PERDA_PALADAR,
            self::TOSSE_PERSISTENTE,
            self::FALTA_AR_PERSISTENTE,
            self::DOR_CABECA_PESISTENTE,
            self::EVENTOS_TROMBOLITICOS,
            self::DANOS_RENAIS,
            self::OUTROS,
        ];
    }

    public static function readables(): array
    {
        return [
            self::PERDA_OLFATO => 'Perda persistente de olfato',
            self::PERDA_PALADAR => 'Perda persistente de paladar',
            self::TOSSE_PERSISTENTE => 'Tosse persistente',
            self::FALTA_AR_PERSISTENTE => 'Falta de ar persistente',
            self::DOR_CABECA_PESISTENTE => 'Dor de cabeça persistente',
            self::EVENTOS_TROMBOLITICOS => 'Eventos tromboliticos',
            self::DANOS_RENAIS => 'Danos renais',
            self::OUTROS => 'Outros',
        ];
    }
}
