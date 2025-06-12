<?php

namespace App\Enums;

enum PermissionsEnum : string
{

    case LIST_USERS = 'list_users';
    case CREATE_USERS = 'create_users';
    case EDIT_USERS   = 'edit_users';
    case DELETE_USERS = 'delete_users';
    case IMPERSONATE_USERS = 'impersonate_users';



    /**
     * Get all permissions as an array of strings.
     */
    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }

}
