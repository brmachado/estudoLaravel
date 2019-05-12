<?php

use Illuminate\Database\Seeder;
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
        User::create([
            'name'      => 'ted',
            'email'     => 'ted@ted.com',
            'password'  => bcrypt('123456'),
        ]);

        User::create([
            'name'      => 'Bruno',
            'email'     => 'bruno@bruno.com',
            'password'  => bcrypt('123456'),
        ]);
    }
}
