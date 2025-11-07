<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function doLogin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('vue-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
    }
    public function doRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:200',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);
    
        $user = $this->userService->createUser($validated);
    
        Auth::login($user);
    
        $token = $user->createToken('vue-token')->plainTextToken;
    
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user
        ]);
    }
    
}
