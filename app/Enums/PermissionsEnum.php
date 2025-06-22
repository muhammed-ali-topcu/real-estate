<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    case LIST_USERS = 'list_users';
    case CREATE_USERS = 'create_users';
    case EDIT_USERS = 'edit_users';
    case DELETE_USERS = 'delete_users';
    case IMPERSONATE_USERS = 'impersonate_users';

    case LIST_PROPERTIES = 'list_properties';
    case CREATE_PROPERTIES = 'create_properties';
    case EDIT_PROPERTIES = 'edit_properties';
    case DELETE_PROPERTIES = 'delete_properties';

    /**
     * Get all permissions as an array of strings.
     */
    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
