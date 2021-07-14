<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Album;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PlaylistRequest;

class PlaylistController extends Controller
{
    public function showPlaylists()
    {
        $albums = Auth::user()->albums;
        $playlists = Auth::user()->playlists;

        return view('playlist', compact('playlists', 'albums'));
    }

    public function createPlaylists()
    {
        return view('createPlaylist');
    }

    public function storePlaylists(Request $request)
    {
        $playlist = new Playlist;
        $playlist->name = $request->name;
        $playlist->user_id = Auth::user()->id;
        $playlist->save();
        
        try {
            $albums = Auth::user()->albums;
            $playlists = Auth::user()->playlists;
            
            return view('playlist', compact('playlists', 'albums'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundPlaylist'));
        }
    }

    public function addAlbum($id)
    {
        try {
            $user = Auth::user()->albums()->attach($id);

            return response()->json([
                'error' => false,
                'artist' => $user,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('playlist.notFoundAlbum'));
        }
    }
}
