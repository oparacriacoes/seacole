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
    public const GRAFICO_14 = 'insumos-oferecidos-projeto1';
    public const GRAFICO_15 = 'insumos-oferecidos-projeto2';
    public const GRAFICO_16 = 'insumos-oferecidos-projeto3';
    public const GRAFICO_17 = 'tratamento-prescrito-medico-projeto';
    public const GRAFICO_18 = 'tratamento-financiado';
    public const GRAFICO_19 = 'dias-sintomas-raca-cor';
    public const GRAFICO_20 = 'dias-sintomas-mais-menos-dias';
    public const GRAFICO_21 = 'total-dias-monitoramento';
    public const GRAFICO_22 = 'casos-monitorados-por-agentes';
    public const GRAFICO_23 = 'casos-avaliados-por-equipe-medica';
    public const GRAFICO_24 = 'acompanhamento-psicologico';
    public const GRAFICO_25 = 'acompanhamento-psicologico-individual-grupo';
    public const GRAFICO_26 = 'avaliacao-medica-raca-cor';
    public const GRAFICO_27 = 'avaliacao-psicologos-raca-cor';
    public const GRAFICO_28 = 'condicoes-saude-a';
    public const GRAFICO_29 = 'condicoes-saude-b';
    public const GRAFICO_30 = 'condicoes-saude-c';
    public const GRAFICO_31 = 'condicoes-saude-d';
    public const GRAFICO_33 = 'uso-drogas-alcool';
    public const GRAFICO_34 = 'informacao-gravidez';
    public const GRAFICO_35 = 'gestacao-alto-risco';
    public const GRAFICO_36 = 'trismeste-gestacao-raca-cor';
    public const GRAFICO_37 = 'acompanhamento-sistema-saude';
    public const GRAFICO_38 = 'acesso-sistema-saude';
    public const GRAFICO_39 = 'quadro-atual-intensifica-medos';
    public const GRAFICO_40 = 'diagnostico-covid-racar-cor';
    public const GRAFICO_41 = 'testes-realizados-raca-cor';
    public const GRAFICO_42 = 'sintomas-manifestados-por-situacao';
    public const GRAFICO_43 = 'sintomas-manifestados-por-situacao-2';
    public const GRAFICO_44 = 'sintomas-manifestados-por-diagnostico';
    public const GRAFICO_45 = 'sintomas-manifestados-por-diagnostico2';
    public const GRAFICO_46 = 'acumulos-sintomas';
    public const GRAFICO_47 = 'desfechos-cor-raca';
    public const GRAFICO_48 = 'sequelas-cor-raca';
    public const GRAFICO_49 = 'idas-servico-referencia-internacao';
    public const GRAFICO_50 = 'deslocamento-servico-saude';
    public const GRAFICO_51 = 'medicacoes-covid-19';
    // public const GRAFICO_52 = '52';
    public const GRAFICO_53 = 'ida-sistema-saude-prescricoes-medicas1';
    public const GRAFICO_54 = 'ida-sistema-saude-prescricoes-medicas2';
    public const GRAFICO_55 = 'ida-sistema-saude-prescricoes-medicas3';
    public const GRAFICO_56 = 'problema-servico-referencia-raca-cor';
    public const GRAFICO_57 = 'ambulancia-financiada-projeto';
    public const GRAFICO_58 = 'local-internacao-raca-cor';
    public const GRAFICO_59 = 'tempo-internacao-raca-cor';
    public const GRAFICO_60 = 'diagnostico-covid-racar-cor';

    public const VACINACAO_GERAL = 'vacinacao-geral';
    public const VACINACAO_POR_VACINA = 'vacinacao-vacina';

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
            self::GRAFICO_14,
            self::GRAFICO_15,
            self::GRAFICO_16,
            self::GRAFICO_17,
            self::GRAFICO_18,
            self::GRAFICO_19,
            self::GRAFICO_20,
            self::GRAFICO_21,
            self::GRAFICO_22,
            self::GRAFICO_23,
            self::GRAFICO_24,
            self::GRAFICO_25,
            self::GRAFICO_26,
            self::GRAFICO_27,
            self::GRAFICO_28,
            self::GRAFICO_29,
            self::GRAFICO_30,
            self::GRAFICO_31,
            self::GRAFICO_33,
            self::GRAFICO_34,
            self::GRAFICO_35,
            self::GRAFICO_36,
            self::GRAFICO_37,
            self::GRAFICO_38,
            self::GRAFICO_39,
            self::GRAFICO_40,
            self::GRAFICO_41,
            self::GRAFICO_42,
            self::GRAFICO_43,
            self::GRAFICO_44,
            self::GRAFICO_45,
            self::GRAFICO_46,
            self::GRAFICO_47,
            self::GRAFICO_48,
            self::GRAFICO_49,
            self::GRAFICO_50,
            self::GRAFICO_51,
            // self::GRAFICO_52,
            self::GRAFICO_53,
            self::GRAFICO_54,
            self::GRAFICO_55,
            self::GRAFICO_56,
            self::GRAFICO_57,
            self::GRAFICO_58,
            self::GRAFICO_59,
            self::GRAFICO_60,
            self::VACINACAO_GERAL,
            self::VACINACAO_POR_VACINA,
        ];
    }

    public static function readables(): array
    {
        return [
            self::CASOS_MONITORADOS => Str::title('01 - NOVOS CASOS MONITORADOS'),
            self::MONITORADOS_EXCLUSIVO_PSICOLOGIA => Str::title('02 - MONITORADOS X EXCLUSIVO PSICOLOGIA'),
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_BAR => Str::title('03 - SITUAÇÃO TOTAL DE CASOS MONITORADOS - Barras'),
            self::SITUACAO_TOTAL_CASOS_MONITORADOS_PIE => Str::title('04 - SITUAÇÃO TOTAL DE CASOS MONITORADOS - Pizza'),
            self::CASOS_MONITORADOS_CIDADE => Str::title('05 - CASOS MONITORADOS POR CIDADE'),
            self::RACA_COR_PESSOAS_ATENDIDAS => Str::title('06 - RAÇA-COR GERAL DAS PESSOAS ATENDIDAS'),
            self::GRAFICO_07 => Str::title('07 - GÊNERO POR RAÇA-COR'),
            self::GRAFICO_08 => Str::title('08 - FAIXA ETÁRIA POR GÊNERO - Pirâmide'),
            self::GRAFICO_09 => Str::title('09 - FAIXA ETÁRIA POR GÊNERO - Barras'),
            self::GRAFICO_10 => Str::title('10 - FAIXA ETÁRIA POR RAÇA COR'),
            self::GRAFICO_11 => Str::title('11 - NÚMERO DE PESSOAS/RESIDÊNCIA POR RAÇA/COR'),
            self::GRAFICO_12_A => Str::title('12a - CLASSE SOCIAL POR RENDA BRUTA FAMILIAR'),
            self::GRAFICO_12_B => Str::title('12b - CLASSE SOCIAL RENDA PER-CAPTA POR RAÇA/COR'),
            self::GRAFICO_13 => Str::title('13 - RAÇA/COR POR AUXÍLIO EMERGENCIAL'),
            self::GRAFICO_14 => Str::title('14 - INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (1)'),
            self::GRAFICO_15 => Str::title('15 - INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (2)'),
            self::GRAFICO_16 => Str::title('16 - INSUMOS OFERECIDOS PELO PROJETO X RAÇA/COR (3)'),
            self::GRAFICO_17 => Str::title('17 - TRATAMENTO PRESCRITO POR MÉDICO DO PROJETO'),
            self::GRAFICO_18 => Str::title('18 - TRATAMENTO FINANCIADO'),
            self::GRAFICO_19 => Str::title('19 - DIAS DE SINTOMAS POR RAÇA/COR'),
            self::GRAFICO_20 => Str::title('20 - DIAS DE SINTOMAS - MAIS OU MENOS DE 10 DIAS'),
            self::GRAFICO_21 => Str::title('21 - TOTAL DE DIAS DE MONITORAMENTO (RELAÇÃO COVID-19)'),
            self::GRAFICO_22 => Str::title('22 - CASOS MONITORADOS POR AGENTES'),
            self::GRAFICO_23 => Str::title('23 - CASOS AVALIADOS POR EQUIPE MÉDICA'),
            self::GRAFICO_24 => Str::title('24 - ACOMPANHAMENTO PSICOLÓGICO'),
            self::GRAFICO_25 => Str::title('25 - ACOMPANHAMENTO PSICOLÓGICO: INDIVIDUAL X EM GRUPO'),
            self::GRAFICO_26 => Str::title('26 - CASOS AVALIADOS POR EQUIPE MÉDICA'),
            self::GRAFICO_27 => Str::title('27 - AVALIAÇÃO PSICÓLOGOS POR RAÇA/COR'),
            self::GRAFICO_28 => Str::title('28 - CONDIÇÕES DE SAÚDE - A'),
            self::GRAFICO_29 => Str::title('29 - CONDIÇÕES DE SAÚDE - B'),
            self::GRAFICO_30 => Str::title('30 - CONDIÇÕES DE SAÚDE - C'),
            self::GRAFICO_31 => Str::title('31 - CONDIÇÕES DE SAÚDE - SAUDE MENTAL  '),
            self::GRAFICO_33 => Str::title('33 - USO CRÔNICO ALCOOL/DROGAS X RAÇA/COR'),
            self::GRAFICO_34 => Str::title('34 - GESTANTE + PÓS-PARTO + AMAMENTA'),
            self::GRAFICO_35 => Str::title('35 - GESTAÇÃO É OU FOI DE ALTO RISCO?'),
            self::GRAFICO_36 => Str::title('36 - TRIMESTRE DA GESTAÇÃO NO INÍCIO DO MONITORAMENTO'),
            self::GRAFICO_37 => Str::title('37 - ACOMPANHAMENTO DO SISTEMA DE SAÚDE'),
            self::GRAFICO_38 => Str::title('38 - COMO ACESSA O SISTEMA DE SAÚDE?'),
            self::GRAFICO_39 => Str::title('39 - QUADRO ATUAL INTENSIFICA MEDOS, ANGÚSTIAS, ANSIEDADE, TRISTEZAS OU PREOCUPAÇÃO?'),
            self::GRAFICO_40 => Str::title('40 - DIAGNÓSTICO DE COVID-19'),
            self::GRAFICO_41 => Str::title('41 - TESTES REALIZADOS?'),
            self::GRAFICO_42 => Str::title('42 - SINTOMAS MANIFESTADOS POR SITUAÇÃO (1)'),
            self::GRAFICO_43 => Str::title('43 - SINTOMAS MANIFESTADOS POR SITUAÇÃO (2)'),
            self::GRAFICO_44 => Str::title('44 - SINTOMAS MANIFESTADOS POR DIAGNÓSTICO (1)'),
            self::GRAFICO_45 => Str::title('45 - SINTOMAS MANIFESTADOS POR DIAGNÓSTICO (2)'),
            self::GRAFICO_46 => Str::title('46 - ACUMULO SINTOMAS'),
            self::GRAFICO_47 => Str::title('47 - DESFECHO'),
            self::GRAFICO_48 => Str::title('48 - SEQUELAS'),
            self::GRAFICO_49 => Str::title('49 - SERVIÇOS DE REFERÊNCIA E INTERNAÇÃO'),
            self::GRAFICO_50 => Str::title('50 - PRECISOU IR A ALGUM SERVIÇO DE SAÚDE?'),
            self::GRAFICO_51 => Str::title('51 - RECEBEU MEDICAÇÕES PARA COVID-19?'),
            // self::GRAFICO_52 => Str::title('52'),
            self::GRAFICO_53 => Str::title('53 PRESCRIÇÕES MEDICAMENTOS DE QUEM FOI AO SISTEMA DE SAÚDE (PESSOAS PRETAS)'),
            self::GRAFICO_54 => Str::title('54 PRESCRIÇÕES MEDICAMENTOS DE QUEM FOI AO SISTEMA DE SAÚDE (PESSOAS PARDAS)'),
            self::GRAFICO_55 => Str::title('55 - PRESCRIÇÕES MEDICAMENTOS DE QUEM FOI AO SISTEMA DE SAÚDE (PESSOAS BRANCA)'),
            self::GRAFICO_56 => Str::title('56 - PROBLEMAS COM SERVIÇOS DE REFERÊNCIA'),
            self::GRAFICO_57 => Str::title('57 - AMBULÂNCIA FINANCIADA PELO PROJETO'),
            self::GRAFICO_58 => Str::title('58 - LOCAL DE INTERNAÇÃO por Raça Cor'),
            self::GRAFICO_59 => Str::title('59 - TEMPO DE INTERNAÇÃO por Raça Cor'),
            // self::GRAFICO_60 => Str::title('Diagnóstico Covid-19 por Raça/Cor'),
            self::VACINACAO_GERAL => '61 - Vacinação Geral',
            // self::VACINACAO_POR_VACINA => '62 - Vacinados por Vacina',
        ];
    }
}
