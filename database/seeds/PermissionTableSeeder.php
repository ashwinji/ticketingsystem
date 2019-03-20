<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $adminUser=new User();
        $adminUser->userType      = '0';
        $adminUser->name          = 'admin';
        $adminUser->lastName      = 'admin';
        $adminUser->email         = 'admin@admin.com';
        $adminUser->password      =  \Hash::make('123456');
        $adminUser->address       = 'XYZ Place';
        $adminUser->city          = 'CityName';
        $adminUser->phone         = '9876543210';
        $adminUser->save();
       

       // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $permissions = [
           'users-list',
           'users-create',
           'users-edit',
           'users-delete',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',
           'app-setting',
           'masters',

           'service-list',
           'service-create',
           'service-edit',

           'ticket-status-list',
           'ticket-status-create',
           'ticket-status-edit',

           'client-list',
           'client-create',
           'client-edit',

           'department-list',
           'department-create',
           'department-edit',
           
           'ticket-generated',
           'ticket-processing',
           'ticket-create',
           'ticket-edit',
           'ticket-view',
           'ticket-list',
           'ticket-report',

        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
        
        // create roles and assign existing permissions
        $role = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $role->givePermissionTo(Permission::all());

        //assign role
        $adminUser->assignRole('admin');
    }
}
