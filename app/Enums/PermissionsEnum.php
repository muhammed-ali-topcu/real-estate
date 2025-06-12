<?php

namespace App\Enums;

enum PermissionsEnum : string
{

    case LIST_USERS = 'list_users';
    case CREATE_USERS = 'create_users';
    case UPDATE_USERS = 'update_users';
    case DELETE_USERS = 'delete_users';
    case IMPERSONATE_USERS = 'impersonate_users';



}
