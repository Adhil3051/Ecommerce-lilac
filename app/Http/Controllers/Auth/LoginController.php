<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    protected $authService;
    public function __construct(AuthService $auth_service){
        $this->authService = $auth_service;
    }
    public function loginForm(Request $request){
        return view('auth.login');
        
    }
    public function doLogin(UserLoginRequest $request){
        $validatedData = $request->validated();
        if ($this->authService->login($validatedData)){
            return redirect()->route('ecommerce');
        }
        return back()->withErrors([
            'email' => 'Invalid credentials or unauthorized access.',
        ])->onlyInput('email');
    }
    public function registerForm(){
        return view('auth.register');
    }
}
