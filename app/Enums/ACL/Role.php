<?php

namespace App\Enums\ACL;

enum Role:string
{

    case AUTHOR = 'author';

    case COLLABORATOR = 'collaborator';

}
