<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Throwable;
use App\Http\Requests\UserRequest;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function index()
    {
        $users = $this->userRepository->all();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request)
    {
        try {
            $user = $this->userRepository->create($request->all());

            return redirect()->route('user.index')->with('susccess', trans('user.addSuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('user.noAdd'));
        }
    }

    public function edit($id)
    {
        try {
            $user = $this->userRepository->findOrFail($id);

            return view('admin.user.update', compact('user'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('user.notId'));
        }
    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = $this->userRepository->update($request->all(), $id);

            return redirect()->route('user.index')->with('susccess', trans('user.updatesuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('user.noUpdate'));
        }
    }

    public function destroy($id)
    {
        return $this->userRepository->destroy($id);
    }
}
