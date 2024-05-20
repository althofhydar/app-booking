<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function  registerProses(Request $request)
    {
       validator::make($request->all(), [
        'nama' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed'
        ])->validate();
    

    $user = User::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'level' => 'User'
    ]);

    event(new Registered($user));

    auth::login($user);

    return redirect('/email/verify');
}


 public function login()
 {
     return view('auth.login');
 }

 public function loginAksi(Request $request)
 {
     Validator::make($request->all(), [
         'email' => 'required|email',
         'password' => 'required'
     ])->validate();

     if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
         throw ValidationException::withMessages([
             'email'=>trans('auth.failed')
         ]);
     }
 

 $request->session()->regenerate();

 return redirect()->route('dashboard');

}

public function logout(Request $request)
{
    Auth::guard('web')->logout();

    return redirect('login');
}

}
