<?php

namespace App\Enums;

enum PropertyListingTypes: string
{
    case SALE = 'sale';
    case RENT = 'rent';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
