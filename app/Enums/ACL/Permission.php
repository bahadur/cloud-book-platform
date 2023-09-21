<?php

namespace App\Enums\ACL;

enum Permission:string
{

    case CREATE_FOLDER = 'create-folder';

    case UPDATE_FOLDER = 'update-folder';

    case DELETE_FOLDER = 'delete-folder';

    case CREATE_FILE = 'create-file';

    case UPDATE_FILE = 'update-file';

    case DELETE_FILE = 'delete-file';

    case GRANT_ROLE = 'grant-role';

    case REVOKE_ROLE = 'revoke-role';

    case VIEW_USERS = 'view-users';
}
