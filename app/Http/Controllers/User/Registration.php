<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;

class Registration extends Controller
{
    public function register(Request $request) 
    {
        $countEmails = Users::where('email', $request->email)->count();
        
        if ($countEmails > 0) {
            return redirect()->route('registration')->with('error', 'Email jest juz zajęty.');
        }
        if ($request->password !== $request->password_confirmation) {
            return redirect()->route('registration')->with('error', 'Podane hasła nie sa identyczne.');
        } 
        
        Users::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'password' => $request->password,
            'adress' => $request->adress,
            'role' => 'USER',
        ]);
        return redirect()->route('registration')->with('success', 'Użytkownik został zarejestrowany. ');
    }

}
