<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Enums\ACL\Role as UserRole;
use App\Enums\ACL\Permission as UserPermission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = Role::firstOrCreate(['name' => UserRole::AUTHOR]);
        $collaborator = Role::firstOrCreate(['name' => UserRole::COLLABORATOR]);

        $usersPermissions = Permission::firstOrCreate(['name' => UserPermission::VIEW_USERS])->assignRole($author);

        $createFolderPermission = Permission::firstOrCreate(['name' => UserPermission::CREATE_FOLDER])->assignRole($author);
        $updateFolderPermission = Permission::firstOrCreate(['name' => UserPermission::UPDATE_FOLDER])->assignRole([$author, $collaborator]);
        $deleteFolderPermission = Permission::firstOrCreate(['name' => UserPermission::DELETE_FOLDER])->assignRole($author);

        $createFilePermission = Permission::firstOrCreate(['name' => UserPermission::CREATE_FILE])->assignRole($author);
        $updateFilePermission = Permission::firstOrCreate(['name' => UserPermission::UPDATE_FILE])->assignRole([$author, $collaborator]);
        $deleteFilePermission = Permission::firstOrCreate(['name' => UserPermission::DELETE_FILE])->assignRole($author);

        $grantRolePermission = Permission::firstOrCreate(['name' => UserPermission::GRANT_ROLE])->assignRole($author);
        $revokeRolePermission = Permission::firstOrCreate(['name' => UserPermission::REVOKE_ROLE])->assignRole($author);




    }
}
