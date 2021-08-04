<?php

namespace App\Repositories\Playlist;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Playlist;
use App\Repositories\BaseRepository;
use App\Repositories\Playlist\IPlaylistRepository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PlaylistRepository extends BaseRepository implements IPlaylistRepository
{
    public function getModel()
    {
        return Playlist::class;
    }

    public function create($data)
    {
        $playlist =  $this->model::create([
            'name' => $data['name'],
            'user_id'=>Auth::user()->id,
        ]);

        return $playlist;
    }

    public function addAlbum($id)
    {
        return Auth::user()->albums()->attach($id);
    }

    public function getAlbumUser()
    {
        return Auth::user()->albums;
    }

    public function getPlaylistUser()
    {
        return Auth::user()->playlists;
    }

    public function destroy($id)
    {
        $playlist = $this->findOrFail($id);
        $playlist->user()->delete();
        $playlist->songs()->wherePivot('playlist_id', '=', $id)->detach();
        $playlist->delete();
    }

    public function addSonginPlaylist($id, $idSong)
    {
        $playlist = $this->findOrFail($id);
        $playlist->songs()->attach($idSong);
    }

    public function delSonginPlaylist($id, $idSong)
    {
        $playlist = $this->findOrFail($id);
        $playlist->songs()->detach($idSong);
    }

    public function addFavoriteSong($idSong)
    {
        $playlists = Auth::user()->playlists;
        $result = $playlists->where('name', '=', 'Favorite');
        if (count($result) == 0) {
            $favorite = new Playlist;
            $favorite->name = "Favorite";
            $favorite->user_id = Auth::user()->id;
            $favorite->save();
        }
        $favorite = $playlists->where('name', '=', 'Favorite')->first();
        $favorite->songs()->attach($idSong);
    }

    public function songResult($id, $search)
    {
        return Song::where('name', 'like', '%'.$search.'%')->take(config('app.home_take_number'))->get();
    }
}
