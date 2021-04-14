<?php

namespace App\Enums;

use Elao\Enum\ReadableEnum;

class OrientacoesSexuais extends ReadableEnum
{
    public const HETEROSSEXUAL = 'heterossexual';
    public const HOMOSSEXUAL = 'homossexual';
    public const BISSEXUAL = 'bissexual';
    public const OUTRO = 'outro';


    public static function values(): array
    {
        return [
            self::HETEROSSEXUAL,
            self::HOMOSSEXUAL,
            self::BISSEXUAL,
            self::OUTRO,
        ];
    }

    public static function readables(): array
    {
        return [
            self::HETEROSSEXUAL => 'Heterossexual',
            self::HOMOSSEXUAL => 'Homossexual',
            self::BISSEXUAL => 'Bissexual',
            self::OUTRO => 'Outro',
        ];
    }
}
