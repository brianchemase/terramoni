<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username'=> 'savani',
            'name' => 'Hardik Savani', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);
    
        $role = Role::create(['name' => 'Admin01']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
    
}
