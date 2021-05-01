<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class DoencasCronicasEnum extends ReadableEnum
{
    public const HAS = '1';
    public const DIABETES_MELLITUES = '2';
    public const DISLIPIDEMIA = '3';
    public const ASMA = '4';
    public const TUBERSULO_ATIVA = '5';
    public const CARDIOPATIAS = '6';
    public const OUTRAS_DOENCAS_RESPIRATORIAS = '7';
    public const ATRITE = '8';
    public const DOENCA_AUTOIMUNE = '9';
    public const DOENCA_RENAL = '10';
    public const DOENCA_NEUROLOGICA = '11';
    public const CANCER = '12';
    public const ANSIEDADE = '13';
    public const DEPRESSAO = '14';
    public const DEMENCIA = '15';
    public const OUTRAS_SAUDE_MENTAL = '16';

    public static function values(): array
    {
        return [
            self::HAS,
            self::DIABETES_MELLITUES,
            self::DISLIPIDEMIA,
            self::ASMA,
            self::TUBERSULO_ATIVA,
            self::CARDIOPATIAS,
            self::OUTRAS_DOENCAS_RESPIRATORIAS,
            self::ATRITE,
            self::DOENCA_AUTOIMUNE,
            self::DOENCA_RENAL,
            self::DOENCA_NEUROLOGICA,
            self::CANCER,
            self::ANSIEDADE,
            self::DEPRESSAO,
            self::DEMENCIA,
            self::OUTRAS_SAUDE_MENTAL,
        ];
    }

    public static function readables(): array
    {
        return [
            self::HAS => 'Hipertensão arterial sistêmica (HAS)',
            self::DIABETES_MELLITUES => 'Diabetes Mellitus (DM)',
            self::DISLIPIDEMIA => 'Dislipidemia',
            self::ASMA => 'Asma / Bronquite',
            self::TUBERSULO_ATIVA => 'Tuberculose ativa',
            self::CARDIOPATIAS => 'Cardiopatias e outras doenças cardiovasculares',
            self::OUTRAS_DOENCAS_RESPIRATORIAS => 'Outras doenças Respiratórias',
            self::ATRITE => 'Artrite/Artrose/Reumatismo',
            self::DOENCA_AUTOIMUNE => 'Doença autoimune',
            self::DOENCA_RENAL => 'Doença renal',
            self::DOENCA_NEUROLOGICA => 'Doença neurológica',
            self::CANCER => 'Câncer',
            self::ANSIEDADE => 'Ansiedade',
            self::DEPRESSAO => 'Depressão',
            self::DEMENCIA => 'Demência',
            self::OUTRAS_SAUDE_MENTAL => 'Outras questões de saúde mental',
        ];
    }
}
