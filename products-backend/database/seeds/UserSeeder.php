<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = config('users');
		foreach($users as $key => $value) {
			User::updateOrCreate(['email'=>$value['email']],
				[
					'name'=>$value['name'],
					'email'=> $value['email'],
					'password' => Hash::make($value['password']),
				]
			);
		}
    }
}
