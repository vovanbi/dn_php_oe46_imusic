<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function all()
    {
        $lyrics = $this->model::allUser()->paginate(config('app.paginateUser'));

        return $lyrics;
    }

    public function create($data)
    {
        $password = bcrypt($data['password']);
        $image = $data['avatar'];
        $image_path = config('app.image_admin') . time() . '.' . $image->getClientOriginalExtension();
        $path = Storage::disk('public')->put($image_path, file_get_contents($image));

        $user = $this->model::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => $password,
            'phone' => $data['phone'],
            'is_admin' => $data['is_admin'],
            'avatar' => $image_path,
        ]);

        return $user;
    }

    public function update($data, $id)
    {
        $user = $this->findOrFail($id);
        if (File::exists(public_path('storage/' . $user->avatar))) {
            File::delete(public_path('storage/' . $user->avatar));
        }
        $password = bcrypt($data['password']);
        $image = $data['avatar'];
        $image_path = config('app.image_admin') . time() . '.' . $image->getClientOriginalExtension();
        $path = Storage::disk('public')->put($image_path, file_get_contents($image));

        if ($user) {
            $user->update([
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'password' => $password,
                'phone' => $data['phone'],
                'is_admin' => $data['is_admin'],
                'avatar' => $image_path,
            ]);

            return $user;
        }

        return false;
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->findOrFail($id);
            if ($user) {
                foreach ($user->playLists as $playlist) {
                    $playList->songs()->detach();
                }
                $user->playLists()->delete();
                $user->comments()->delete();
                $user->lyrics()->delete();
                $user->albums()->detach();
                $user->delete();
            }
            DB::commit();

            return response()->json([
                'error' => false,
                'user'=> $user
            ], 200);
        } catch (Throwable $e) {
            DB::rollback();
        }
    }

    public function changePassword($data)
    {
        $user_id = Auth::user()->id;
        $user = $this->findOrFail($user_id);
        $passwordOld = $data['passwordOld'];
        $passwordNew = $data['passwordNew'];
        $passwordconfirm = $data['passwordconfirm'];
        $mess = [];
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
