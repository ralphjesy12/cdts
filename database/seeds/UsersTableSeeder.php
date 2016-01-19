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
            'gender' => 'male'
        ]);

        factory(App\Exams::class, 10)->create()->each(function($u) {
            for ($i=0; $i < 5; $i++) {
                $u->questions()->save(factory(App\Question::class)->make());
            }
        });
    }
}
