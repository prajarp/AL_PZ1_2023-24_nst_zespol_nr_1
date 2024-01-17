<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Login extends Controller
{
    public function login(Request $request)
    {
        $bookId = session()->get('id');
        
        
        
        $user = Users::where('email', $request->email)->get()->first();

        if (!isset($user) || $user->count() == 0) {
            return redirect()->route('login')->with('error', 'Użytkownik nie istnieje');
        }
        
        if ($user->password !== $request->password) {
            return redirect()->route('login')->with('error', 'Nieprawidlowe hasło');
        }

        session()->put('user', $request->email);
        session()->put('userRole', $user->role);

        if ($bookId !== null) {
            Redirect::setIntendedUrl(route('bookId', ['id' => $bookId]));
        }
        return redirect()->intended();
    }
}
