<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class DesfechosEnum extends ReadableEnum
{
    public const SEQUELAS_NAO_LIMITANTES = 'Com sequelas não-limitantes (ex: não recuperou olfato)';
    public const SEQUELAS_INCAPACITANTES = 'Com sequelas incapacitantes (ex: não recuperou capacidade pulmonar)';
    public const OBITO_COVID = 'Óbito por covid como principal causa';
    public const OBITO_OUTRAS = 'Óbito por outras causas';

    public static function values(): array
    {
        return [
            self::SEQUELAS_NAO_LIMITANTES,
            self::SEQUELAS_INCAPACITANTES,
            self::OBITO_COVID,
            self::OBITO_OUTRAS,
        ];
    }

    public static function readables(): array
    {
        return [
            self::SEQUELAS_NAO_LIMITANTES => 'Com sequelas não-limitantes (ex: não recuperou olfato)',
            self::SEQUELAS_INCAPACITANTES => 'Com sequelas incapacitantes (ex: não recuperou capacidade pulmonar)',
            self::OBITO_COVID => 'Óbito por covid como principal causa',
            self::OBITO_OUTRAS => 'Óbito por outras causas',
        ];
    }
}
