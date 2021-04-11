<?php

namespace App\Enums;

use Elao\Enum\FlaggedEnum;

final class SituacoesCaso extends FlaggedEnum
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
            static::CASO_ATIVO_GRAVE,
            static::CASO_ATIVO_LEVE,
            static::CONTATO_CASO_CONFIRMADO_ATIVO,
            static::OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_ATIVOS,
            static::EXCLUSIVO_PSICOLOGIA_ATIVO,
            static::MONITORAMENTO_ENCERRADO_GRAVE_SEGUE_APENAS_COM_PSICOLOGOS,
            static::MONITORAMENTO_ENCERRADO_LEVE_SEGUE_APENAS_COM_PSICOLOGOS,
            static::MONITORAMENTO_ENCERRADO_CONTATO_SEGUE_APENAS_COM_PSICOLOGOS,
            static::MONITORAMENTO_ENCERRADO_OUTROS_SEGUE_APENAS_COM_PSICOLOGOS,
            static::CASO_FINALIZADO_GRAVE,
            static::CASO_FINALIZADO_LEVE,
            static::CONTATO_COM_CASO_CONFIRMADO_FINALIZADO ,
            static::OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_FINALIZADO ,
            static::EXCLUSIVO_PSICOLOGIA_FINALIZADO
        ];
    }

    public static function readables(): array
    {
        return [
            static::CASO_ATIVO_GRAVE => 'Caso ativo GRAVE',
            static::CASO_ATIVO_LEVE => 'Caso ativo LEVE',
            static::CONTATO_CASO_CONFIRMADO_ATIVO => 'Contato caso confirmado - ativo',
            static::OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_ATIVOS => 'Outras situações (sem relaçãoo com COVID-19) - ativos',
            static::EXCLUSIVO_PSICOLOGIA_ATIVO => 'Exclusivo psicologia - ativo',
            static::MONITORAMENTO_ENCERRADO_GRAVE_SEGUE_APENAS_COM_PSICOLOGOS => 'Monitoramento encerrado GRAVE - segue apenas com psicólogos',
            static::MONITORAMENTO_ENCERRADO_LEVE_SEGUE_APENAS_COM_PSICOLOGOS => 'Monitoramento encerrado LEVE - segue apenas com psicólogos',
            static::MONITORAMENTO_ENCERRADO_CONTATO_SEGUE_APENAS_COM_PSICOLOGOS => 'Monitoramento encerrado contato - segue apenas com psicólogos',
            static::MONITORAMENTO_ENCERRADO_OUTROS_SEGUE_APENAS_COM_PSICOLOGOS => 'Monitoramento encerrado outros - segue apenas com psicólogos',
            static::CASO_FINALIZADO_GRAVE => 'Caso finalizado GRAVE',
            static::CASO_FINALIZADO_LEVE => 'Caso finalizado LEVE',
            static::CONTATO_COM_CASO_CONFIRMADO_FINALIZADO  => 'Contato com caso confirmado - finalizado',
            static::OUTRAS_SITUACOES_SEM_RELACAO_COM_COVID_19_FINALIZADO  => 'Outras situaçõees (sem relação com COVID-19) - finalizado',
            static::EXCLUSIVO_PSICOLOGIA_FINALIZADO => 'Exclusivo psicologia - finalizado'
        ];
    }
}
