<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class ServicosSaudeEnum extends ReadableEnum
{
    public const UBS = 'ubs';
    public const UPA = 'upa';
    public const AMA = 'ama';
    public const HOSPITAL_PUBLICO = 'hospital-publico';
    public const HOSPITAL_PRIVADO = 'hospital-privado';
    public const OUTRO = 'outro';


    public static function values(): array
    {
        return [
            self::UBS,
            self::UPA,
            self::AMA,
            self::HOSPITAL_PUBLICO,
            self::HOSPITAL_PRIVADO,
            self::OUTRO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::AMA => 'AMA',
            self::HOSPITAL_PUBLICO => 'Hospital Público',
            self::HOSPITAL_PRIVADO => 'Hospital Privado',
            self::UBS => 'UBS (Unidade Básica de Saúde)',
            self::UPA => 'UPA (Unidade de Pronto Atendimento)',
            self::OUTRO => 'Outro',
        ];
    }
}
