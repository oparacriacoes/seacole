<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;
use Illuminate\Support\Str;

final class ChartsEnum extends ReadableEnum
{
    public const CASOS_MONITORADOS = 'novos-casos-monitorados';
    public const MONITORADOS_EXCLUSIVO_PSICOLOGIA = 'monitorados-exclusivo-psicologia';
    public const SITUACAO_TOTAL_CASOS_MONITORADOS_BAR = 'situacao-total-casos-monitorados-bar';
    public const SITUACAO_TOTAL_CASOS_MONITORADOS_PIE = 'situacao-total-casos-monitorados-pie';
    public const CASOS_MONITORADOS_CIDADE = 'casos-monitorado-cidade';
    public const RACA_COR_PESSOAS_ATENDIDAS = 'raca-cor-pessoas-atendidas';
    public const GRAFICO_07 = 'genero-por-raca-cor';
    public const GRAFICO_08 = 'faixa-etaria-por-genero';
    public const GRAFICO_09 = 'faixa-etaria-por-genero-b';
    public const GRAFICO_10 = 'faixa-etaria-por-raca-cor';
    public const GRAFICO_11 = 'pessoas-residencia-raca-cor';
    public const GRAFICO_12_A = 'classe-social-por-renda-familiar';
    public const GRAFICO_12_B = 'classe-social-renda-per-capta-raca-cor';
    public const GRAFICO_13 = 'raca-cor-auxilio-emergencial';

    public const GRAFICO_15 = '15';
    public const GRAFICO_16 = '16';
    public const GRAFICO_17 = 'tratamento-prescrito-medico-projeto';
    public const GRAFICO_18 = '18';
    public const GRAFICO_19 = 'dias-sintomas-raca-cor';
    public const GRAFICO_20 = 'dias-sintomas-mais-menos-dias';
    public const GRAFICO_21 = '21';
    public const GRAFICO_22 = 'casos-monitorados-por-agentes';
    public const GRAFICO_23 = 'casos-avaliados-por-equipe-medica';
    public const GRAFICO_24 = 'acompanhamento-psicologico';
    public const GRAFICO_25 = 'acompanhamento-psicologico-individual-grupo';
    public const GRAFICO_26 = 'avaliacao-medica-raca-cor';
    public const GRAFICO_27 = 'avaliacao-psicologos-raca-cor';
    public const GRAFICO_28 = '28';
    public const GRAFICO_29 = '29';
    public const GRAFICO_30 = '30';
    public const GRAFICO_31 = '31';
    public const GRAFICO_32 = '32';
    public const GRAFICO_33 = '33';
    public const GRAFICO_34 = '34';
    public const GRAFICO_35 = '35';
    public const GRAFICO_36 = '36';
    public const GRAFICO_37 = '37';
    public const GRAFICO_38 = '38';
    public const GRAFICO_39 = '39';
    public const GRAFICO_40 = '40';
    public const GRAFICO_41 = '41';
    public const GRAFICO_42 = '42';
    public const GRAFICO_43 = '43';
    public const GRAFICO_44 = '44';
    public const GRAFICO_45 = '45';
    public const GRAFICO_46 = '46';
    public const GRAFICO_47 = '47';
    public const GRAFICO_48 = '48';
    public const GRAFICO_49 = '49';
    public const GRAFICO_50 = '50';
    public const GRAFICO_51 = '51';
    public const GRAFICO_52 = '52';
    public const GRAFICO_53 = '53';
    public const GRAFICO_54 = '54';
    public const GRAFICO_55 = '55';
    public const GRAFICO_56 = '56';
    public const GRAFICO_57 = '57';
    public const GRAFICO_58 = 'local-internacao-raca-cor';
    public const GRAFICO_59 = 'tempo-internacao-raca-cor';
    public const GRAFICO_60 = 'diagnostico-covid-racar-cor';

    public static function values(): array
    {
        return [
            self::CASOS_MONITORADOS,
            self::MONITORADOS_EXCLUSIVO_PSICOLOGIA,
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_BAR,
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_PIE,
            self::CASOS_MONITORADOS_CIDADE,
            self::RACA_COR_PESSOAS_ATENDIDAS,
            self::GRAFICO_07,
            self::GRAFICO_08,
            self::GRAFICO_09,
            self::GRAFICO_10,
            self::GRAFICO_11,
            self::GRAFICO_12_A,
            self::GRAFICO_12_B,
            self::GRAFICO_13,

            // self::GRAFICO_14,
            // self::GRAFICO_15,
            // self::GRAFICO_16,
            self::GRAFICO_17,
            // self::GRAFICO_18,
            self::GRAFICO_19,
            self::GRAFICO_20,
            // self::GRAFICO_21,
            self::GRAFICO_22,
            self::GRAFICO_23,
            self::GRAFICO_24,
            self::GRAFICO_25,
            self::GRAFICO_26,
            self::GRAFICO_27,
            // self::GRAFICO_28,
            // self::GRAFICO_29,
            // self::GRAFICO_30,
            // self::GRAFICO_31,
            // self::GRAFICO_32,
            // self::GRAFICO_33,
            // self::GRAFICO_34,
            // self::GRAFICO_35,
            // self::GRAFICO_36,
            // self::GRAFICO_37,
            // self::GRAFICO_38,
            // self::GRAFICO_39,
            // self::GRAFICO_40,
            // self::GRAFICO_41,
            // self::GRAFICO_42,
            // self::GRAFICO_43,
            // self::GRAFICO_44,
            // self::GRAFICO_45,
            // self::GRAFICO_46,
            // self::GRAFICO_47,
            // self::GRAFICO_48,
            // self::GRAFICO_49,
            // self::GRAFICO_50,
            // self::GRAFICO_51,
            // self::GRAFICO_52,
            // self::GRAFICO_53,
            // self::GRAFICO_54,
            // self::GRAFICO_55,
            // self::GRAFICO_56,
            // self::GRAFICO_57,
            self::GRAFICO_58,
            self::GRAFICO_59,
            self::GRAFICO_60,
        ];
    }

    public static function readables(): array
    {
        return [
            self::CASOS_MONITORADOS => Str::title('01 NOVOS CASOS MONITORADOS'),
            self::MONITORADOS_EXCLUSIVO_PSICOLOGIA => Str::title('02 MONITORADOS X EXCLUSIVO PSICOLOGIA'),
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_BAR => Str::title('03 SITUAÇÃO TOTAL DE CASOS MONITORADOS - Barras'),
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_PIE => Str::title('04 SITUAÇÃO TOTAL DE CASOS MONITORADOS - Pizza'),
            self::CASOS_MONITORADOS_CIDADE => Str::title('05 CASOS MONITORADOS POR CIDADE'),
            self::RACA_COR_PESSOAS_ATENDIDAS => Str::title('06 RAÇA-COR GERAL DAS PESSOAS ATENDIDAS'),
            self::GRAFICO_07 => Str::title('07 GÊNERO POR RAÇA-COR'),
            self::GRAFICO_08 => Str::title('08 FAIXA ETÁRIA POR GÊNERO - Pirâmide'),
            self::GRAFICO_09 => Str::title('09 FAIXA ETÁRIA POR GÊNERO - Barras'),
            self::GRAFICO_10 => Str::title('10 FAIXA ETÁRIA POR RAÇA COR'),
            self::GRAFICO_11 => Str::title('11 NÚMERO DE PESSOAS/RESIDÊNCIA POR RAÇA/COR'),
            self::GRAFICO_12_A => Str::title('12a CLASSE SOCIAL POR RENDA BRUTA FAMILIAR'),
            self::GRAFICO_12_B => Str::title('12b CLASSE SOCIAL RENDA PER-CAPTA POR RAÇA/COR'),
            self::GRAFICO_13 => Str::title('13 RAÇA/COR POR AUXÍLIO EMERGENCIAL'),

            // self::GRAFICO_14 => Str::title('14'),
            // self::GRAFICO_15 => Str::title('15'),
            // self::GRAFICO_16 => Str::title('16'),
            self::GRAFICO_17 => Str::title('17 TRATAMENTO PRESCRITO POR MÉDICO DO PROJETO'),
            // self::GRAFICO_18 => Str::title('18'),
            self::GRAFICO_19 => Str::title('19 DIAS DE SINTOMAS POR RAÇA/COR'),
            self::GRAFICO_20 => Str::title('20 DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS'),
            // self::GRAFICO_21 => Str::title('21'),
            self::GRAFICO_22 => Str::title('22 CASOS MONITORADOS POR AGENTES'),
            self::GRAFICO_23 => Str::title('23 CASOS AVALIADOS POR EQUIPE MÉDICA'),
            self::GRAFICO_24 => Str::title('24 ACOMPANHAMENTO PSICOLÓGICO'),
            self::GRAFICO_25 => Str::title('25 ACOMPANHAMENTO PSICOLÓGICO: INDIVIDUAL X EM GRUPO'),
            self::GRAFICO_26 => Str::title('26 CASOS AVALIADOS POR EQUIPE MÉDICA'),
            self::GRAFICO_27 => Str::title('27 AVALIAÇÃO PSICÓLOGOS POR RAÇA/COR'),
            // self::GRAFICO_28 => Str::title('28'),
            // self::GRAFICO_29 => Str::title('29'),
            // self::GRAFICO_30 => Str::title('30'),
            // self::GRAFICO_31 => Str::title('31'),
            // self::GRAFICO_32 => Str::title('32'),
            // self::GRAFICO_33 => Str::title('33'),
            // self::GRAFICO_34 => Str::title('34'),
            // self::GRAFICO_35 => Str::title('35'),
            // self::GRAFICO_36 => Str::title('36'),
            // self::GRAFICO_37 => Str::title('37'),
            // self::GRAFICO_38 => Str::title('38'),
            // self::GRAFICO_39 => Str::title('39'),
            // self::GRAFICO_40 => Str::title('40'),
            // self::GRAFICO_41 => Str::title('41'),
            // self::GRAFICO_42 => Str::title('42'),
            // self::GRAFICO_43 => Str::title('43'),
            // self::GRAFICO_44 => Str::title('44'),
            // self::GRAFICO_45 => Str::title('45'),
            // self::GRAFICO_46 => Str::title('46'),
            // self::GRAFICO_47 => Str::title('47'),
            // self::GRAFICO_48 => Str::title('48'),
            // self::GRAFICO_49 => Str::title('49'),
            // self::GRAFICO_50 => Str::title('50'),
            // self::GRAFICO_51 => Str::title('51'),
            // self::GRAFICO_52 => Str::title('52'),
            // self::GRAFICO_53 => Str::title('53'),
            // self::GRAFICO_54 => Str::title('54'),
            // self::GRAFICO_55 => Str::title('55'),
            // self::GRAFICO_56 => Str::title('56'),
            // self::GRAFICO_57 => Str::title('57'),
            self::GRAFICO_58 => Str::title('58 LOCAL DE INTERNAÇÃO por Raça Cor'),
            self::GRAFICO_59 => Str::title('59 TEMPO DE INTERNAÇÃO por Raça Cor'),
            self::GRAFICO_60 => Str::title('60 Diagnóstico Covid-19 por Raça/Cor'),
        ];
    }
}
