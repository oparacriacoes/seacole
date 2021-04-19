<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class RolesEnum extends ReadableEnum
{
    public const AGENTE = 'agente';
    public const MEDICO = 'medico';
    public const PSICOLOGO = 'psicologo';
    public const ADMINISTRADOR = 'administrador';

    public static function values(): array
    {
        return [
            self::ADMINISTRADOR,
            self::AGENTE,
            self::MEDICO,
            self::PSICOLOGO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::ADMINISTRADOR => 'Administrador',
            self::AGENTE => 'Agente',
            self::MEDICO => 'Médico',
            self::PSICOLOGO => 'Psicólogo',
        ];
    }
}
