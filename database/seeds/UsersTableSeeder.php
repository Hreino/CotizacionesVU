<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user= new User();
        $user->name = 'Hector';
        $user->initials = 'HR';
        $user->email = 'hector@toursuniversales.com';
        $user->password =Hash::make('11111111');
        $user->save();
    }
}
