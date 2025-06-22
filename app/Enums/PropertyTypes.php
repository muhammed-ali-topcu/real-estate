<?php

namespace App\Enums;

enum PropertyTypes: string
{
    case HOUSE = 'house';
    case APARTMENT = 'apartment';
    case SHOP = 'shop';
    case OFFICE = 'office';
    case LAND = 'land';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
