<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class LocaisInternacaoEnum extends ReadableEnum
{
    public const HOSPITAL_PUBLICO_REFERENCIA = 'Hospital público de referência';
    public const HOSPITAL_CAMPANHA = 'Hospital de campanha';
    public const HOSPITAL_PARTICULAR_REFERENCIA = 'Hospital particular de referência';
    public const HOSPITAL_MUNICIPAL_IPIRANGA = 'Hospital municipal do Ipiranga (encaminhado pelo projeto)';
    public const HOSPITAL_PRIVADO_PROJETO = 'Hospital privado financiado pelo projeto';
    public const HOSPITAL_OUTRO_HOSPITAL_PUBLICO = 'Outro hospital público';

    public static function values(): array
    {
        return [
            self::HOSPITAL_PUBLICO_REFERENCIA,
            self::HOSPITAL_CAMPANHA,
            self::HOSPITAL_PARTICULAR_REFERENCIA,
            self::HOSPITAL_MUNICIPAL_IPIRANGA,
            self::HOSPITAL_PRIVADO_PROJETO,
            self::HOSPITAL_OUTRO_HOSPITAL_PUBLICO
        ];
    }

    public static function readables(): array
    {
        return [
            self::HOSPITAL_PUBLICO_REFERENCIA => 'Hospital Público de Referência',
            self::HOSPITAL_CAMPANHA => 'Hospital de Campanha',
            self::HOSPITAL_PARTICULAR_REFERENCIA => 'Hospital particular de referência',
            self::HOSPITAL_MUNICIPAL_IPIRANGA => 'Hospital municipal do Ipiranga (encaminhado pelo projeto)',
            self::HOSPITAL_PRIVADO_PROJETO => 'Hospital privado financiado pelo projeto',
            self::HOSPITAL_OUTRO_HOSPITAL_PUBLICO => 'Outro hospital público'
        ];
    }
}
