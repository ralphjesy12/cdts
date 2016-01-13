<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => 'Administrator',
            'email' => 'admin@cdts.com',
            'password' => bcrypt('1234'),
            'username' => 'admin',
            'position' => 'Admin',
            'level' => '4',
            'gender' => 'M'
        ]);
    }
}
