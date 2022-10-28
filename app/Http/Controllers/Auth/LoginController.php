<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/projects')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withError('Login details are not valid');
    }
}
