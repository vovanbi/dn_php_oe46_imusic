<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Throwable;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(UserRequest $request)
    {
        try {
            $user = new User();
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->route('get.login')->with('susccess', 'Regiter sucsss !');
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', 'Regiter not success !');
        }
    }
}
