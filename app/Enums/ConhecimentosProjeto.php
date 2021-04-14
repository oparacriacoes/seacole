<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;
use Illuminate\Support\Str;

final class ConhecimentosProjeto extends ReadableEnum
{
    public const NUCLEO = 'núcleo da Uneafro';
    public const ANUNCIO_CARTAZ = 'faixa ou cartaz na rua';
    public const AUTOMOVEL_SONORO = 'carro ou bicicleta de som';
    public const WHATSAPP = 'whatsapp';
    public const INSTAGRAM = 'instagram';
    public const FACEBOOK = 'facebook';
    public const TWITTER = 'twitter';
    public const EMAIL = 'e-mail';
    public const INDICACAO = 'indicação de amigo, vizinho ou familiar';
    public const OUTRO = 'Outro';


    public static function values(): array
    {
        return [
            self::NUCLEO,
            self::ANUNCIO_CARTAZ,
            self::AUTOMOVEL_SONORO,
            self::WHATSAPP,
            self::INSTAGRAM,
            self::FACEBOOK,
            self::TWITTER,
            self::EMAIL,
            self::INDICACAO,
            self::OUTRO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::NUCLEO => Str::title(self::NUCLEO),
            self::ANUNCIO_CARTAZ => Str::title(self::ANUNCIO_CARTAZ),
            self::AUTOMOVEL_SONORO => Str::title(self::AUTOMOVEL_SONORO),
            self::WHATSAPP => Str::title(self::WHATSAPP),
            self::INSTAGRAM => Str::title(self::INSTAGRAM),
            self::FACEBOOK => Str::title(self::FACEBOOK),
            self::TWITTER => Str::title(self::TWITTER),
            self::EMAIL => Str::title(self::EMAIL),
            self::INDICACAO => Str::title(self::INDICACAO),
            self::OUTRO => Str::title(self::OUTRO),
        ];
    }
}
