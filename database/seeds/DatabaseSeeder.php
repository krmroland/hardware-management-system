<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        cache()->flush();
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@sales.com',
            'password' => bcrypt('password'),
            'phoneNumber' => '0772742016',
            'isAdmin' => true,
        ]);
    }
}
