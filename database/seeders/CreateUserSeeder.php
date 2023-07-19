<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'User',
               'email'=>'user@tera.com',
               'mobile_no'=>'077255',
               'username'=>'User Name',
               'role'=> 0,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Editor',
               'email'=>'editor@tera.com',
               'mobile_no'=>'071522562',
               'username'=>'Editor User',
               'role'=> 1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Admin Brian',
               'email'=>'admin@tera.com',
               'mobile_no'=>'0702230627',
               'username'=>'Brian Anikayi',
               'role'=> 2,
               'password'=> bcrypt('123456'),
            ],
            
        ];
    
        foreach ($users as $key => $user) 
        {
            User::create($user);
        }
    }
}
