<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class PageDetailController extends Controller
{
    public function showAlbum($album)
    {
        try {
            $album = Album::find($album);
            $songs = $album->songs;

            return view('detail', compact('album', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('pageDetail.notFoundAlbum'));
        }
    }

    public function showArtist($artist)
    {
        try {
            $artist = Artist::find($artist);
            $songs = $artist->songs;

            return view('detail', compact('artist', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('pageDetail.notFoundArtist'));
        }
    }
}
