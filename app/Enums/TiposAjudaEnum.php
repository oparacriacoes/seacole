<?php

namespace App\Enums;

use Elao\Enum\Enum;

final class TiposAjudaEnum extends Enum
{
    public const COMPRA_REMEDIO_USO_CONTINUO = 'Comprar remédios de uso contínuo';
    public const COMPRA_REMEDIO_TRATAMENTO_QUADRO_ATUAL = 'Comprar remédios para o tratamento do quadro atual';
    public const COMPRA_ALIMENTO_CESTA_BASICA = 'Comprar alimento ou outro produtos de necessidade básica';
    public const OUTROS = 'Outros';


    public static function values(): array
    {
        return [
            self::COMPRA_REMEDIO_USO_CONTINUO,
            self::COMPRA_REMEDIO_TRATAMENTO_QUADRO_ATUAL,
            self::COMPRA_ALIMENTO_CESTA_BASICA,
            self::OUTROS,
        ];
    }
}
