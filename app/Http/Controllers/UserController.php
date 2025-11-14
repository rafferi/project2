<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('auth.reg');
    }

    public function signup(RegisterRequest $request)
    {
        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);

        User::create($userData);

        return back()->with('success', 'Регистрация прошла успешно!');
    }

    public function auth()
    {
        return view('auth.auth');
    }

    public function login(LoginRequest $request)
    {
        if(auth()->attempt($request->validated())){
            return redirect()->route('products.index');
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль.',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
