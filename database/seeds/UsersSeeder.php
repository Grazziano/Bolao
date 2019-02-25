<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\User::firstOrCreate(['email'=>'grazzianofagundes@gmail.com'], [
        'name'=>'Grazziano',
        'password'=>Hash::make('123456'),
      ]);

      \App\User::firstOrCreate(['email'=>'laracroft@mail.com'], [
        'name'=>'Lara Croft',
        'password'=>Hash::make('123456'),
      ]);

      \App\User::firstOrCreate(['email'=>'indianajones@mail.com'], [
        'name'=>'Indiana Jones',
        'password'=>Hash::make('123456'),
      ]);

        echo "Usuários criados!\n";
    }
}
