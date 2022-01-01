<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dashboard = Permission::create([
            'name' => 'dashboard-read',
            'display_name' => 'Доступ в админ панель',
            'description' => 'Доступ в админ панель',
        ]);

        $superuser = Role::find(1);
        $superuser->attachPermission($dashboard);
        $user = User::find(1);
        $user->attachRole($superuser);
    }
}
