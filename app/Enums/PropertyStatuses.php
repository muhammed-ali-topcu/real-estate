<?php

namespace App\Enums;

enum PropertyStatuses: string
{

    const STATUS_PENDING  = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_SOLD     = 'sold';
    const STATUS_RENTED   = 'rented';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }


}
