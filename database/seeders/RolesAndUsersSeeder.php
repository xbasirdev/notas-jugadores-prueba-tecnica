<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'create notes']);
        Permission::firstOrCreate(['name' => 'view all notes']);

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $author = Role::firstOrCreate(['name' => 'author']);
        $player = Role::firstOrCreate(['name' => 'player']);

        // Assign permissions to roles
        $admin->givePermissionTo(['manage users', 'create notes', 'view all notes']);
        $author->givePermissionTo(['create notes', 'view all notes']);
        // player has only view own notes by business rule, no global permission

        // Create admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Administrator', 'password' => bcrypt('password')]
        );
        $adminUser->assignRole($admin);

        // Create an author
        $authorUser = User::firstOrCreate(
            ['email' => 'author@example.com'],
            ['name' => 'Author User', 'password' => bcrypt('password')]
        );
        $authorUser->assignRole($author);

        // Create a player user
        $playerUser = User::firstOrCreate(
            ['email' => 'player@example.com'],
            ['name' => 'Player User', 'password' => bcrypt('password')]
        );
        $playerUser->assignRole($player);
    }
}
