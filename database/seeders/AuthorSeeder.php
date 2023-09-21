<?php

namespace Database\Seeders;

use App\Enums\ACL\Role as UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $author = User::updateOrCreate([
            'email' => 'author@domain.com'
        ],[
            'name' => 'Author',
            'password' => bcrypt('12345678')
        ]);

        $author->assignRole('author');
    }
}
