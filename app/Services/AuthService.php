<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
     public function login(array $credentials): bool
    {
        if (Auth::attempt([
            'name' => $credentials['name'],
            'password' => $credentials['password'],
        ])) {
            session()->regenerate();
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}