<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;
use Illuminate\Support\Str;

final class NucleosUneafro extends ReadableEnum
{
    public const CONCEICAO_EVARISTO = 'CONCEIÇÃO EVARISTO';
    public const UNEAFRO_YABAS = 'UNEAFRO YABÁS';
    public const MANDELA = 'MANDELA';
    public const GUERREIROS_ALVINOPOLIS = 'GUERREIROS ALVINÓPOLIS';
    public const MARIELLE_FRANCO = 'MARIELLE FRANCO';
    public const KLEBER_CRIOULO = 'KLEBER CRIOULO';
    public const VILA_FATIMA = 'VILA FÁTIMA';
    public const UNEAFRO_MABEL_ASSIS = 'UNEAFRO MABEL ASSIS';
    public const BOM_PASTOR = 'BOM PASTOR';
    public const UNEAFRO_ASSIS = 'UNEAFRO ASSIS';
    public const MARGARIDA_ALVES = 'MARGARIDA ALVES';
    public const DONA_NAZINHA = 'DONA NAZINHA';
    public const LUIZA_MAHIN = 'LUIZA MAHIN';
    public const CLEMENTINA_DE_JESUS = 'CLEMENTINA DE JESUS';
    public const NUCLEO_LA_DA_LESTE = 'NÚCLEO LÁ DA LESTE';
    public const SERGIO_LAPALOMA = 'SÉRGIO LAPALOMA';
    public const SUELI_CARNEIRO = 'SUELI CARNEIRO';
    public const TIA_JURA = 'TIA JURA';
    public const NOVA_PALESTINA = 'NOVA PALESTINA';
    public const RAQUEL_TRINDADE = 'RAQUEL TRINDADE';
    public const ASSATA_SHAKUR = 'ASSATA SHAKUR';
    public const ILDA_MARTINS = 'ILDA MARTINS';
    public const UNEAFRO_MOGI = 'UNEAFRO MOGI';
    public const CAROLINA_MARIA_DE_JESUS = 'CAROLINA MARIA DE JESUS';
    public const UNEAFRO_NA_DISCIPLINA = 'UNEAFRO NA DISCIPLINA';
    public const UNEAFRO_QUILOMBAQUE = 'UNEAFRO QUILOMBAQUE';
    public const XI_DE_AGOSTO = 'XI DE AGOSTO';
    public const EDUCACAO_LIBERTA = 'EDUCAÇÃO LIBERTA';
    public const ROSA_PARKS = 'ROSA PARKS';
    public const ANTONIO_CANDEIA_FILHO = 'ANTÔNIO CANDEIA FILHO';
    public const UNEAFRO_MSTC = 'UNEAFRO MSTC';
    public const UNEAFRO_LUZ = 'UNEAFRO LUZ';


    public static function values(): array
    {
        return [
            self::CONCEICAO_EVARISTO,
            self::UNEAFRO_YABAS,
            self::MANDELA,
            self::GUERREIROS_ALVINOPOLIS,
            self::MARIELLE_FRANCO,
            self::KLEBER_CRIOULO,
            self::VILA_FATIMA,
            self::UNEAFRO_MABEL_ASSIS,
            self::BOM_PASTOR,
            self::UNEAFRO_ASSIS,
            self::MARGARIDA_ALVES,
            self::DONA_NAZINHA,
            self::LUIZA_MAHIN,
            self::CLEMENTINA_DE_JESUS,
            self::NUCLEO_LA_DA_LESTE,
            self::SERGIO_LAPALOMA,
            self::SUELI_CARNEIRO,
            self::TIA_JURA,
            self::NOVA_PALESTINA,
            self::RAQUEL_TRINDADE,
            self::ASSATA_SHAKUR,
            self::ILDA_MARTINS,
            self::UNEAFRO_MOGI,
            self::CAROLINA_MARIA_DE_JESUS,
            self::UNEAFRO_NA_DISCIPLINA,
            self::UNEAFRO_QUILOMBAQUE,
            self::XI_DE_AGOSTO,
            self::EDUCACAO_LIBERTA,
            self::ROSA_PARKS,
            self::ANTONIO_CANDEIA_FILHO,
            self::UNEAFRO_MSTC,
            self::UNEAFRO_LUZ
        ];
    }

    public static function readables(): array
    {
        return [
            self::CONCEICAO_EVARISTO => Str::title(self::CONCEICAO_EVARISTO),
            self::UNEAFRO_YABAS => Str::title(self::UNEAFRO_YABAS),
            self::MANDELA => Str::title(self::MANDELA),
            self::GUERREIROS_ALVINOPOLIS => Str::title(self::GUERREIROS_ALVINOPOLIS),
            self::MARIELLE_FRANCO => Str::title(self::MARIELLE_FRANCO),
            self::KLEBER_CRIOULO => Str::title(self::KLEBER_CRIOULO),
            self::VILA_FATIMA => Str::title(self::VILA_FATIMA),
            self::UNEAFRO_MABEL_ASSIS => Str::title(self::UNEAFRO_MABEL_ASSIS),
            self::BOM_PASTOR => Str::title(self::BOM_PASTOR),
            self::UNEAFRO_ASSIS => Str::title(self::UNEAFRO_ASSIS),
            self::MARGARIDA_ALVES => Str::title(self::MARGARIDA_ALVES),
            self::DONA_NAZINHA => Str::title(self::DONA_NAZINHA),
            self::LUIZA_MAHIN => Str::title(self::LUIZA_MAHIN),
            self::CLEMENTINA_DE_JESUS => Str::title(self::CLEMENTINA_DE_JESUS),
            self::NUCLEO_LA_DA_LESTE => Str::title(self::NUCLEO_LA_DA_LESTE),
            self::SERGIO_LAPALOMA => Str::title(self::SERGIO_LAPALOMA),
            self::SUELI_CARNEIRO => Str::title(self::SUELI_CARNEIRO),
            self::TIA_JURA => Str::title(self::TIA_JURA),
            self::NOVA_PALESTINA => Str::title(self::NOVA_PALESTINA),
            self::RAQUEL_TRINDADE => Str::title(self::RAQUEL_TRINDADE),
            self::ASSATA_SHAKUR => Str::title(self::ASSATA_SHAKUR),
            self::ILDA_MARTINS => Str::title(self::ILDA_MARTINS),
            self::UNEAFRO_MOGI => Str::title(self::UNEAFRO_MOGI),
            self::CAROLINA_MARIA_DE_JESUS => Str::title(self::CAROLINA_MARIA_DE_JESUS),
            self::UNEAFRO_NA_DISCIPLINA => Str::title(self::UNEAFRO_NA_DISCIPLINA),
            self::UNEAFRO_QUILOMBAQUE => Str::title(self::UNEAFRO_QUILOMBAQUE),
            self::XI_DE_AGOSTO => Str::title(self::XI_DE_AGOSTO),
            self::EDUCACAO_LIBERTA => Str::title(self::EDUCACAO_LIBERTA),
            self::ROSA_PARKS => Str::title(self::ROSA_PARKS),
            self::ANTONIO_CANDEIA_FILHO => Str::title(self::ANTONIO_CANDEIA_FILHO),
            self::UNEAFRO_MSTC => Str::title(self::UNEAFRO_MSTC),
            self::UNEAFRO_LUZ => Str::title(self::UNEAFRO_LUZ),
        ];
    }
}
