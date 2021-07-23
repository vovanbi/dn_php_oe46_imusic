<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Category;
use App\Support\Facades\DB;

class HomeController extends Controller
{
    public function changeLanguage($locale)
    {
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function index()
    {
        $categories = Category::isParent()->get();
        $songs = Song::orderBy('created_at', 'desc')->take(config('app.home_take_number'))->get();
        $albums = Album::orderBy('created_at', 'desc')->take(config('app.home_take_number'))->get();
        $artists = Artist::has('songs')->take(config('app.home_take_number'))->get();

        return view('home', compact('songs', 'albums', 'artists', 'categories'));
    }

    public function songPlaying($id)
    {
        try {
            $song = Song::find($id);

            return view('song-play', compact('song'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('songNotFound'));
        }
    }

    public function getSong($id)
    {
        $songs = Song::ofCategory($id)->get();
        $songs = $songs->map(function ($item) {
            $item->setAttribute('artist_name', $item->artist->name);

            return $item;
        });

        return response()->json($songs, 200);
    }

    public function renderHome(Request $request)
    {
        $artists = Artist::getAll()->limit(6)->get();
        $albums  = Album::albumHot()->get();
        $songs = Song::songHot()->get();

        return response()->json(['songs' => $songs, 'artists' => $artists , 'albums' => $albums], 200);
    }

    public function hotAlbumMusic($id)
    {
        $songs = Song::where('hot', $id)->get();
        $songs = $songs->map(function ($item) {
            $item->setAttribute('artist_name', $item->artist->name);

            return $item;
        });
        $albums = Album::where('hot', $id)->get();

        return response()->json(['songs' => $songs, 'albums' => $albums], 200);
    }

    public function topTrending()
    {
        $songs = Song::select('view', 'name')->whereMonth('created_at', date('m'))
        ->orderBy('view', 'desc')->get();

        return view('music.top-trending', compact('songs'));
    }
}
