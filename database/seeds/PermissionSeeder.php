<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminTo = User::create(['name' => 'rodolfo', 'surname' => 'molina', 'email' => 'admin@gmail.com', 'password' => Hash::make('admin')]);
        $role = Role::create(['name' => 'administrador']);
        $permission_array = [];
        array_push($permission_array, Permission::create(['name' => 'Administrador de seguridad']));
        array_push($permission_array, Permission::create(['name' => 'create_users']));
        $adminTo->assignRole($role->id);
        $role->syncPermissions($permission_array);
    }
}