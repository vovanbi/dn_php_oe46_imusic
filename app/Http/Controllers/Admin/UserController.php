<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Throwable;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    public function index()
    {
        $users = User::allUser()->paginate(config('app.paginateUser'));
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {

        $userParent = User::where('id', '=', config('app.userParent'))->get();
        return view('admin.user.create', compact('userParent'));
    }

    public function store(UserRequest $request)
    {
        try {
            $user = new User();
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->is_admin = $request->is_admin;
            $image = $request->avatar;
            $image_path = config('app.image_admin') . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/image_admin');
            $image->move($path, $image_path);
            $user->avatar = $image_path;
            $user->save();

            return redirect()->route('user.index')->with('susccess', trans('user.addSuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('user.noAdd'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $userParent = User::where('id', '=', config('app.userParent'))->get();

            return view('admin.user.update', compact(['user', 'userParent']));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('user.notId'));
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->phone = $request->phone;
            $user->is_admin = $request->is_admin;
            $image = $request->avatar;
            $image_path = config('app.image_admin'). time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/image_admin');
            $image->move($path, $image_path);
            $user->avatar = $image_path;
            $user->update();

            return redirect()->route('user.index')->with('susccess', trans('user.updatesuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('user.noUpdate'));
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::destroy($id);
                return response()->json([
                    'error' => false,
                    'user' => $user
                     ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('user.Nodelete'));
        }
    }
}
