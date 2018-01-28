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
        $id = DB::table('users')->insertGetId([
            'name' => "admin",
            'username' => 'admin@api',
            'email' => 'admin@api',
            'password' => app('hash')->make('abc123')
        ]);

        // create permissions
        Permission::create(['name' => 'users get']);
        Permission::create(['name' => 'users set']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('users get');
        $role->givePermissionTo('users set');

        $user = User::find($id);
        $user->assignRole('admin');

    }
}
