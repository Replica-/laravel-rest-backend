<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Organisation User",
            'username' => 'org@test',
            'email' => 'org@test',
            'password' => app('hash')->make('abc123')
        ]);

        DB::table('users')->insert([
            'name' => "Branch User",
            'username' => 'branch@test',
            'email' => 'branch@test',
            'password' => app('hash')->make('abc123')
        ]);

        DB::table('users')->insert([
            'name' => "user",
            'username' => 'user@gmail.com',
            'email' => 'user@gmail.com',
            'password' => app('hash')->make('abc123')
        ]);
    }
}
