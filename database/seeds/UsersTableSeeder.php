<?php

use Illuminate\Database\Seeder;
use Recursos_Humanos\User;
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
        	'name' 	  => 'samuel lechuga',
        	'email' 	  => 'samuel.lechuga@grupointerconsult.com',
            'email_verified_at'       => null,
            'password'        => bcrypt('gimslg2106'),
            'remember_token'  => '',
            'Employee_id' => NULL
        ]);
    }
}
