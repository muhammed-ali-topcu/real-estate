<?php

namespace App\Enums;

enum PropertyTypes: string
{
    const PROPERTY_TYPE_HOUSE = 'house';
    const PROPERTY_TYPE_APARTMENT = 'apartment';
    const PROPERTY_TYPE_SHOP = 'shop';
    const PROPERTY_TYPE_OFFICE = 'office';
    const PROPERTY_TYPE_LAND = 'land';


    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }


}
