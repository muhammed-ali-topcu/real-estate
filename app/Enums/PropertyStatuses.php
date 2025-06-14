<?php

namespace App\Enums;

enum PropertyStatuses: string
{

    case PENDING         = 'pending';
    case APPROVED        = 'approved';
    case REJECTED = 'rejected';
    case SOLD     = 'sold';
    case RENTED   = 'rented';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }


}
