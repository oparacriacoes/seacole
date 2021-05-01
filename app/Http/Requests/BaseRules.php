<?php

namespace App\Http\Requests;

class BaseRules {
    public const STRING = ['string', 'max:190', 'nullable'];
    public const TEXT = ['string', 'max:10240', 'nullable'];
    public const DATE = ['date', 'nullable', 'before_or_equal:now'];
    public const TIME = ['date_format:H:i', 'nullable'];
    public const BOOLEAN = ['nullable', 'boolean'];
    public const ARRAY = ['nullable', 'array'];
    public const INTEGER = ['nullable', 'integer'];

}
