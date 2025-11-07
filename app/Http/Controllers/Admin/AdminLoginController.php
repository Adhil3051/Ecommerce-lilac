<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    //
    protected $authService;
    public function __construct(AuthService $auth_service){
        $this->authService = $auth_service;
    }
    public function loginForm(Request $request){
        return view('admin.auth.login');
    }
    public function adminLoginPost(LoginRequest $request){
        
        $validatedData = $request->validated();
        if ($this->authService->login($validatedData)){
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors([
            'email' => 'Invalid credentials or unauthorized access.',
        ])->onlyInput('email');

    }
    public function logout(Request $request){
        $this->authService->logout();
        return redirect()->route('ecommerce');
    }
}
