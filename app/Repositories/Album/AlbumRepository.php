<?php

namespace App\Repositories\Album;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Album;
use App\Jobs\SendEmailAlbum;
use Pusher\Pusher;
use App\Events\AlbumNotifyEvent;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Notifications\NewAlbumNotify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use App\Repositories\Album\IAlbumRepository;
use Illuminate\Support\Facades\Notification;

class AlbumRepository extends BaseRepository implements IAlbumRepository
{
    public function getModel()
    {
        return Album::class;
    }

    public function delFavAlbum($id)
    {
        return  Auth::user()->albums()->detach($id);
    }

    public function getAlbumNew()
    {
        return $this->model::orderBy('created_at', 'desc')->take(config('app.home_take_number'))->get();
    }

    public function getAlbumHot()
    {
        return $this->model->songHot();
    }

    public function searchName($search)
    {
        return $this->model->searchName($search)->take(config('app.home_take_number'))->get();
    }

    public function searchAlbum($search)
    {
        return $this->model->searchName($search)->paginate(config('app.search_take_num'));
    }
    
    public function all()
    {
        $albums = $this->model::orderBy('id')->paginate(config('app.paginate_num'));
        
        return $albums;
    }

    public function create($data)
    {
        $image = $data['image'];
        $image_path = 'image_album/' . time() . '.' . $image->getClientOriginalExtension();
        $path = Storage::disk('public')->put($image_path, file_get_contents($image));
        $album = $this->model::create([
            'name' => $data['name'],
            'image' => $image_path,
        ]);

        $users = User::isNotAdmin()->get();
        foreach ($users as $user) {
            dispatch(new SendEmailAlbum($user, $album))->delay(Carbon::now()->addSeconds(3));
            $user->notify(new NewAlbumNotify($album));
        }

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $title = trans('home.newAlbumNoti');
        $time = $album->created_at->diffForHumans();

        $pusher->trigger('AlbumNotifyEvent', 'send-message', ['album' => $album, 'time' => $time, 'title' => $title]);

        return $album;
    }

    public function update($data, $album)
    {
        $album = $this->findOrFail($album);
        if (File::exists(public_path('storage/' . $album->image))) {
            File::delete(public_path('storage/' . $album->image));
        }
        $image = $data['image'];
        $image_path = 'image_album/' . time() . '.' . $image->getClientOriginalExtension();
        $path = Storage::disk('public')->put($image_path, file_get_contents($image));
        if ($album) {
            $album->update([
                'name' => $data['name'],
                'image' => $image_path,
            ]);

            return $album;
        }

        return false;
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $album = $this->findOrFail($id);
            if ($album) {
                $album->users()->delete();
                $album->songs()->detach();
                $album->delete();
            }
            DB::commit();

            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {
            DB::rollBack();
        }
    }

    public function pinHotAlbum($action, $id)
    {
        $album = $this->findOrFail($id);
        if ($album) {
            switch ($action) {
                case 'hot':
                    $album->hot = $album->hot ? config('app.notHot') : config('app.Hot');
                    $album->save();
                    break;
            }

            return true;
        }

        return false;
    }

    public function showSongsInAlbum($album)
    {
        $album = $this->findOrFail($album);
        if ($album) {
            $songs = $album->songs()->paginate(config('app.paginate_num'));

            return $songs;
        }

        return false;
    }

    public function addSongToAlbum($album, $song)
    {
        $album = $this->findOrFail($album);
        if ($album) {
            $album->songs()->attach($song);

            return $album;
        }

        return false;
    }

    public function delSongInAlbum($album, $song)
    {
        $album = $this->findOrFail($album);
        if ($album) {
            $album->songs()->detach($song);

            return $album;
        }

        return false;
    }

    public function markAsRead($id)
    {
        $noti = DB::table('notifications')->where('id', $id)->update(['read_at' => Carbon::now()]);
    }
}
