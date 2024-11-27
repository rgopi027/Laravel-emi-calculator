<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import DB facade
use Illuminate\Support\Facades\Hash; // Import the Hash facade

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
        	[
                'name' => 'developer',
                'email' => 'developer@test.com',
                'password' => Hash::make('123'), // Encrypting the password
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('users')->insert([
        	[
                'name' => 'Gopi',
                'email' => 'gopi@techcmantix.com',
                'password' => Hash::make('demo1234'), // Encrypting the password
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}