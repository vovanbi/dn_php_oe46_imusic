<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Throwable;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function proFile($id)
    {
        try {
            $user = User::findOrFail($id);

            return view('user.profile', compact('user'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('home.Notid'));
        }
    }

    public function changePassword(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        $passwordOld = $request->get('passwordOld');
        $passwordNew = $request->get('passwordNew');
        $passwordconfirm = $request->get('passwordconfirm');
        $mess  = [];
        if (Hash::check($passwordOld, $user->password)) {
            if ($passwordNew == $passwordconfirm) {
                $user->password = bcrypt($passwordNew);
                $user->save();
                $mess['success'] = trans('home.changesuccss');

                return response()->json($mess, 200);
            } else {
                $mess['notrepair'] = trans('home.repair');

                return response()->json($mess, 200);
            }
        } else {
            $mess['notpass'] = trans('home.notpass');

            return response()->json($mess, 200);
        }
    }
}
