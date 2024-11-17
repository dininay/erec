<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
          'view courses',  
          'create courses',  
          'edit courses',  
          'delete courses'  
        ];

        foreach($permissions as $permission){
            Permission::create([
                'name' => $permission
            ]);
        }

        $hrRole = Role::create([
            'name' => 'HR'
        ]);

        $hrRole->givePermissionTo([
            'view courses',  
            'create courses',  
            'edit courses',  
            'delete courses'  
        ]);

        $crewRole = Role::create([
            'name' => 'Crew'
        ]);

        $crewRole->givePermissionTo([
            'view courses',  
        ]);

        //Akun Admin
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@miegacoan.com',
            'password' => bcrypt('admin123')
        ]);

        $user->assignRole($hrRole);
    }
}
