<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class TiposAjudaEnum extends ReadableEnum
{
    public const COMPRA_REMEDIO_USO_CONTINUO = 'remedios-uso-continuo';
    public const COMPRA_REMEDIO_TRATAMENTO_QUADRO_ATUAL = 'remedio-tratamento-quadro-atual';
    public const COMPRA_ALIMENTO_CESTA_BASICA = 'alimento-cesta-basica';
    public const OUTROS = 'outros';


    public static function values(): array
    {
        return [
            self::COMPRA_REMEDIO_USO_CONTINUO,
            self::COMPRA_REMEDIO_TRATAMENTO_QUADRO_ATUAL,
            self::COMPRA_ALIMENTO_CESTA_BASICA,
            self::OUTROS,
        ];
    }

    public static function readables(): array
    {
        return [
            self::COMPRA_REMEDIO_USO_CONTINUO => 'Comprar remédios de uso contínuo',
            self::COMPRA_REMEDIO_TRATAMENTO_QUADRO_ATUAL => 'Comprar remédios para o tratamento do quadro atual',
            self::COMPRA_ALIMENTO_CESTA_BASICA => 'Comprar alimento ou outro produtos de necessidade básica',
            self::OUTROS => 'Outros',
        ];
    }
}
