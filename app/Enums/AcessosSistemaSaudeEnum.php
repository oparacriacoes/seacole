<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

final class AcessosSistemaSaudeEnum extends ReadableEnum
{
    public const USA_SUS = 'É usuária/o do SUS (público)';
    public const TEM_CONVENIO = 'Tem convênio/plano de saúde';
    public const USA_SERVICOS_PAGOS_POPULAR = 'Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)';
    public const USA_SERVICOS_PAGOS_SEM_CONVENIO = 'Usuária/o de serviços particulares não cobertos por convênios';


    public static function values(): array
    {
        return [
            self::USA_SUS,
            self::TEM_CONVENIO,
            self::USA_SERVICOS_PAGOS_POPULAR,
            self::USA_SERVICOS_PAGOS_SEM_CONVENIO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::USA_SUS => 'É usuária/o do SUS (público)',
            self::TEM_CONVENIO => 'Tem convênio/plano de saúde',
            self::USA_SERVICOS_PAGOS_POPULAR => 'Usuária/o de serviços pagos "populares" (Ex: Dr Consulta)',
            self::USA_SERVICOS_PAGOS_SEM_CONVENIO => 'Usuária/o de serviços particulares não cobertos por convênios',
        ];
    }
}
