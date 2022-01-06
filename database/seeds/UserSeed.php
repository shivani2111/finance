<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'dob' => date('Y-m-d'),
            'address' => '',
            'contact_no' => '9876543210',
            'gender' => 'female',
            'state_id' => 1,
            'city_id' => 1
        ]);
        $user->assignRole('administrator');

    }
}
