<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function login(Request $request)
    {
        $user = Users::where('email', $request->email)->get()->first();

        if (!isset($user) || $user->count() == 0) {
            return redirect()->route('login')->with('error', 'Uzytkownik nie istnieje');
        }
        
        if ($user->password !== $request->password) {
            return redirect()->route('login')->with('error', 'Nieprawidlowe haslo');
        }

        session()->put('user', $request->email);
        session()->put('userRole', $user->role);

        return redirect()->route('welcome');
    }
}
