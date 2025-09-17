<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginname' => 'required|string',
            'loginpassword' => 'required|string',
        ]);

        if (Auth::attempt(['name' => $incomingFields['loginname'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are logged in!');
        } else {
            return redirect('/')->with('error', 'Login failed');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'You have been logged out!');
    }

    public function register(Request $request)
    {
        // Handle registration logic here
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user =  User::create($incomingFields);
        Auth::login($user);
        if (Auth::check()) {
             return redirect('/')->with('success', 'You are logged in!');
        } else {
            return redirect('/')->with('error', 'Login failed');
        }

       
    }
}
