<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollaboratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collaborator = User::updateOrCreate([
            'email' => 'collaborator@domain.com'
        ],[
            'name' => 'Collaborator',
            'password' => bcrypt('12345678')
        ]);

        $collaborator->assignRole('collaborator');
    }
}
