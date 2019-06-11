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
        App\User::create([
            'user_type_id' => 2,
            'name' => 'aminnova',
            'email' => 'aminnova.apps@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }
}
