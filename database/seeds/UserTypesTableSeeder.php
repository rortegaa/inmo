<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\UserType::create([
            'user_type' => 'General',
            'inserted_by' => 'DBSeeder'
        ]);

        App\UserType::create([
            'user_type' => 'Administrator',
            'inserted_by' => 'DBSeeder'
        ]);
    }
}
