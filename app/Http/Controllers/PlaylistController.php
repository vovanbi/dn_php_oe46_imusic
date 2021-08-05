<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\User;
use App\Models\Album;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PlaylistRequest;
use App\Repositories\Playlist\IPlaylistRepository;
use App\Repositories\Album\IAlbumRepository;

class PlaylistController extends Controller
{
    protected $playlistRepository;
    protected $albumReporitory;

    public function __construct(
        IPlaylistRepository $playlistRepository,
        IAlbumRepository $albumReporitory
    ) {
        $this->playlistRepository = $playlistRepository;
        $this->albumReporitory = $albumReporitory;
    }
    public function showPlaylists()
    {
        $albums = $this->playlistRepository->getAlbumUser();
        $playlists = $this->playlistRepository->getPlaylistUser();

        return view('playlist', compact('playlists', 'albums'));
    }

    public function createPlaylists()
    {
        return view('createPlaylist');
    }

    public function storePlaylists(Request $request)
    {
        $playlist = $this->playlistRepository->create($request->all());
        try {
            $albums = $this->playlistRepository->getAlbumUser();
            $playlists = $this->playlistRepository->getPlaylistUser();
            
            return view('playlist', compact('playlists', 'albums'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function addAlbum($id)
    {
        try {
            $user = $this->playlistRepository->addAlbum($id);

            return response()->json([
                'error' => false,
                'user' => $user,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundAlbum'));
        }
    }

    public function playlistDetail($id)
    {
        try {
            $playlist = $this->playlistRepository->findOrFail($id);
            $songs = $playlist->songs;
            
            return view('playlistSong', compact('songs', 'playlist'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function favoriteAlbum($id)
    {
        try {
            $album = $this->albumReporitory->findOrFail($id);
            $songs = $album->songs;
            
            return view('playlistSong', compact('songs', 'album'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function delPlaylist($id)
    {
        try {
            $this->playlistRepository->destroy($id);

            return response()->json([
                'error' => false
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function delFavAlbum($id)
    {
        try {
            $this->albumReporitory->delFavAlbum($id);
    
            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundAlbum'));
        }
    }

    public function showSongList($id)
    {
        return view('showAddSong', compact('id'));
    }
    
    public function songResult($playlistId, $search)
    {
        try {
            $songs = $this->playlistRepository->songResult($playlistId, $search);
            return view('songResult', compact('songs', 'playlistId'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.noSearchFound'));
        }
    }

    public function addPlaylistSong($id, $idSong)
    {
        try {
            $this->playlistRepository->addSonginPlaylist($id, $idSong);

            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.noPlaylistFound'));
        }
    }

    public function delPlaylistSong($id, $idSong)
    {
        try {
            $this->playlistRepository->delSonginPlaylist($id, $idSong);
            
            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.noPlaylistFound'));
        }
    }

    public function addFavoriteSong($idSong)
    {
        $this->playlistRepository->addSonginPlaylist($idSong);

        return response()->json([
            'error' => false,
        ], 200);
    }
}
