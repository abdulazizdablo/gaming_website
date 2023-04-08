<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        Permission::create(['name' => 'create-games']);
        Permission::create(['name' => 'edit-games']);
        Permission::create(['name' => 'delete-games']);

        $adminRole = Role::create(['name' => 'Admin']);
        $developerRole = Role::create(['name' => 'Developer']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
        
        ]);

        $developerRole->givePermissionTo([
            'create-games',
            'edit-games',
            'delete-games',
        ]);


    }
}
