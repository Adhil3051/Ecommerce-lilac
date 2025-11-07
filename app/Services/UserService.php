<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function createUser(array $data): User
    {
        // Create and return the user
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => 'user', 
        ]);
    }
}