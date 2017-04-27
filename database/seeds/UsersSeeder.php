<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // sample admin
      App\User::create([
          'name' => 'Admin',
          'email' => 'admin@gmail.com',
          'password' => bcrypt('secret'),
          'role' => 'admin'
      ]);

      // sample customer
      App\User::create([
          'name' => 'customer',
          'email' => 'customer@gmail.com',
          'password' => bcrypt('secret'),
          'role' => 'customer'
      ]);
    }
}
