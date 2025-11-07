<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        //
        $password = Hash::make(123456);
        User::insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => $password,
                'role' => 'admin'
                
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => $password,
                'role' => 'user'
            ]
        ]);
        User::factory(10)->create();
    }
}
