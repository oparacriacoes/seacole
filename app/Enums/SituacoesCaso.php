<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class SituacoesCaso extends ReadableEnum
{
    public const CASO_ATIVO_GRAVE = 1;
    public const CASO_ATIVO_LEVE = 2;
    public const CONTATO_CASO_CONFIRMADO_ATIVO = 3;
    public const OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_ATIVOS = 4;
    public const EXCLUSIVO_PSICOLOGIA_ATIVO = 5;
    public const MONITORAMENTO_ENCERRADO_GRAVE_SEGUE_APENAS_COM_PSICOLOGOS = 6;
    public const MONITORAMENTO_ENCERRADO_LEVE_SEGUE_APENAS_COM_PSICOLOGOS = 7;
    public const MONITORAMENTO_ENCERRADO_CONTATO_SEGUE_APENAS_COM_PSICOLOGOS = 8;
    public const MONITORAMENTO_ENCERRADO_OUTROS_SEGUE_APENAS_COM_PSICOLOGOS = 9;
    public const CASO_FINALIZADO_GRAVE = 10;
    public const CASO_FINALIZADO_LEVE = 11;
    public const CONTATO_COM_CASO_CONFIRMADO_FINALIZADO = 12;
    public const OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_FINALIZADO = 13;
    public const EXCLUSIVO_PSICOLOGIA_FINALIZADO = 14;


    public static function values(): array
    {
        return [
            self::CASO_ATIVO_GRAVE,
            self::CASO_ATIVO_LEVE,
            self::CONTATO_CASO_CONFIRMADO_ATIVO,
            self::OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_ATIVOS,
            self::EXCLUSIVO_PSICOLOGIA_ATIVO,
            self::MONITORAMENTO_ENCERRADO_GRAVE_SEGUE_APENAS_COM_PSICOLOGOS,
            self::MONITORAMENTO_ENCERRADO_LEVE_SEGUE_APENAS_COM_PSICOLOGOS,
            self::MONITORAMENTO_ENCERRADO_CONTATO_SEGUE_APENAS_COM_PSICOLOGOS,
            self::MONITORAMENTO_ENCERRADO_OUTROS_SEGUE_APENAS_COM_PSICOLOGOS,
            self::CASO_FINALIZADO_GRAVE,
            self::CASO_FINALIZADO_LEVE,
            self::CONTATO_COM_CASO_CONFIRMADO_FINALIZADO ,
            self::OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_FINALIZADO ,
            self::EXCLUSIVO_PSICOLOGIA_FINALIZADO
        ];
    }

    public static function readables(): array
    {
        return [
            self::CASO_ATIVO_GRAVE => 'Caso ativo GRAVE',
            self::CASO_ATIVO_LEVE => 'Caso ativo LEVE',
            self::CONTATO_CASO_CONFIRMADO_ATIVO => 'Contato caso confirmado - ativo',
            self::OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_ATIVOS => 'Outras situações (sem relaçãoo com COVID-19) - ativos',
            self::EXCLUSIVO_PSICOLOGIA_ATIVO => 'Exclusivo psicologia - ativo',
            self::MONITORAMENTO_ENCERRADO_GRAVE_SEGUE_APENAS_COM_PSICOLOGOS => 'Monitoramento encerrado GRAVE - segue apenas com psicólogos',
            self::MONITORAMENTO_ENCERRADO_LEVE_SEGUE_APENAS_COM_PSICOLOGOS => 'Monitoramento encerrado LEVE - segue apenas com psicólogos',
            self::MONITORAMENTO_ENCERRADO_CONTATO_SEGUE_APENAS_COM_PSICOLOGOS => 'Monitoramento encerrado contato - segue apenas com psicólogos',
            self::MONITORAMENTO_ENCERRADO_OUTROS_SEGUE_APENAS_COM_PSICOLOGOS => 'Monitoramento encerrado outros - segue apenas com psicólogos',
            self::CASO_FINALIZADO_GRAVE => 'Caso finalizado GRAVE',
            self::CASO_FINALIZADO_LEVE => 'Caso finalizado LEVE',
            self::CONTATO_COM_CASO_CONFIRMADO_FINALIZADO  => 'Contato com caso confirmado - finalizado',
            self::OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_FINALIZADO  => 'Outras situaçõees (sem relação com COVID-19) - finalizado',
            self::EXCLUSIVO_PSICOLOGIA_FINALIZADO => 'Exclusivo psicologia - finalizado'
        ];
    }
}
