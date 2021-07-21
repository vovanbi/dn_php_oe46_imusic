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

            return view('detail', compact('album'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('pageDetail.notFoundAlbum'));
        }
    }

    public function showArtist($artist)
    {
        try {
            $artist = Artist::find($artist);

            return view('detail', compact('artist'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('pageDetail.notFoundArtist'));
        }
    }
}
