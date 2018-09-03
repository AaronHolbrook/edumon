<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        DB::table('users')->insert([
            [
                'name' => 'aaron',
                'email' => 'tyrun@fastmail.com',
                'password' => bcrypt('dev'),
            ]
        ]);
    }
}
