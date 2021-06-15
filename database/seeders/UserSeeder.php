<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin', // will Hash automatically in setter method (User class)
            'role_id' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Ali AlQahtani',
            'username' => 'ali',
            'email' => 'ali@ali.com',
            'password' => 'ali',
            'role_id' => 2,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Yasser',
            'username' => 'yasser',
            'email' => 'yasser@yasser.com',
            'password' => 'yasser',
            'role_id' => 3,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Saad',
            'username' => 'saad',
            'email' => 'saad@saad.com',
            'password' => 'saad',
            'role_id' => 3,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Ahmed',
            'username' => 'ahmed',
            'email' => 'ahmed@ahmed.com',
            'password' => 'ahmed',
            'role_id' => 3,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
