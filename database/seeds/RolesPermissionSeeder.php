<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
/*
        // create permissions
        Permission::create(['name' => 'users get']);
        Permission::create(['name' => 'users set']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('users get');
        $role->givePermissionTo('users set');

        DB::table('users')->insert([
            'name' => "admin",
            'username' => 'admin@api',
            'email' => 'admin@api',
            'password' => app('hash')->make('abc123')
        ]);
*/
        $user = User::find(2);
        $user->assignRole('admin');

    }
}
