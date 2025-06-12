<?php

namespace App\Enums;

enum RolesEnum: string
{
    //case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case USER  = 'user';

//    public function label(): string
//    {
//        return match ($this) {
//            self::ADMIN => __('Admin'),
//            self::USER => __('USER'),
//        };
//    }

    /**
     * Get all permissions as an array of strings.
     */
    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }


}
