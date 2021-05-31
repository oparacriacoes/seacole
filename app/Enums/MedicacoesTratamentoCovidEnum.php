<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class MedicacoesTratamentoCovidEnum extends ReadableEnum
{
    public const AZITROMICINA = 'azitromicina';
    public const ANTIBIOTICO = 'antibiotico';
    public const IVERMECTINA = 'ivermectina';
    public const CLOROQUINA = 'cloroquina-hidroxicloroquina';
    public const OSELTAMIVIR = 'oseltamivir';
    public const ALERGICO = 'antialergico';
    public const CORTICOIDE = 'corticoide';
    public const ANTIINFLAMATORIO = 'antiinflamatorio';
    public const VITAMINA_D = 'vitamina-d';
    public const ZINCO = 'zinco';
    public const OUTRO = 'outro';


    public static function values(): array
    {
        return [
            self::AZITROMICINA,
            self::ANTIBIOTICO,
            self::IVERMECTINA,
            self::CLOROQUINA,
            self::OSELTAMIVIR,
            self::CORTICOIDE,
            self::ALERGICO,
            self::ANTIINFLAMATORIO,
            self::VITAMINA_D,
            self::ZINCO,
            self::OUTRO,

        ];
    }

    public static function readables(): array
    {
        return [
            self::AZITROMICINA => 'Azitromicina',
            self::ANTIBIOTICO => 'Outro Antibiótico',
            self::IVERMECTINA => 'Ivermectina',
            self::CLOROQUINA => 'Cloroquina/Hidroxicloroquina',
            self::OSELTAMIVIR => 'Oseltamivir (Tamiflu)',
            self::CORTICOIDE => 'Algum corticóide',
            self::ALERGICO => 'Algum Alérgico',
            self::ANTIINFLAMATORIO => 'Algum Antiinflamatório',
            self::VITAMINA_D => 'Vitamina D',
            self::ZINCO => 'Zinco',
            self::OUTRO => 'Outro Medicamento',
        ];
    }
}
