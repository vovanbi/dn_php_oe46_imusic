<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Throwable;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\IUserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function proFile($id)
    {
        try {
            $user = $this->userRepository->findOrFail($id);

            return view('user.profile', compact('user'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('home.Notid'));
        }
    }

    public function changePassword(Request $request)
    {
        $this->userRepository->changePassword($request->all());
    }
}
