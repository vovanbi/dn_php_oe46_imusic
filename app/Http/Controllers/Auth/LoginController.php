<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __contructor()
    {
        $this->middleware('auth');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (auth()->attempt($credentials)) {
                if (auth()->user()->is_admin == 1) {
                    return redirect()->route('admin.home');
                } else {
                    return redirect()->route('home');
                }
            } else {
                return redirect()->back()
                    ->with('error', 'Email-Address And Password Are Wrong.');
            }
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Login not success');
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
