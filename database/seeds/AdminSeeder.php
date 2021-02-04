<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      if(User::count()==0){
      \App\User::create([
          'name' => "Mohamed Adel",
          'email' => "mohamedadelanwer@hotmail.com",
          'password' => bcrypt("qwe@1234")
      ]);
      }
      if(\App\Roles::count()==0){
          \App\Roles::create([
              'name' => "SuperAdmin",
          ]);

          \App\UserRoles::create([
              'user_id' => 1,
              'role_id' =>1
          ]);
      }
    }
}
