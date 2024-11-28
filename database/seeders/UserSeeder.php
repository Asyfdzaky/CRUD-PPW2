<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeder untuk level 'admin'
        DB::table('users')->insert([
            'name' => 'Admin User 2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'), // Gantilah password sesuai keinginan
            'level' => 'admin',
            'email_verified_at' => now(),
        
        ]);

        // Seeder untuk level 'user'
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'level' => 'user',
            'email_verified_at' => now(),
            
        ]);

        // Seeder untuk level 'internal_reviewer'
        DB::table('users')->insert([
            'name' => 'Internal Reviewer 2',
            'email' => 'reviewer2@example.com',
            'password' => Hash::make('password'),
            'level' => 'internal_reviewer',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
