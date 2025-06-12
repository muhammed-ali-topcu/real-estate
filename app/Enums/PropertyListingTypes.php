<?php

namespace App\Enums;

enum PropertyListingTypes: string
{
    const LISTING_TYPE_SALE = 'sale';
    const LISTING_TYPE_RENT = 'rent';


    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }


}
