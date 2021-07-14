<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Category;
use App\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            $song->view += 1;
            $song->save();

            return view('song-play', compact('song'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('homePage.songNotFound'));
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
        $songs = Song::select('view', 'name', 'id', 'image')->whereMonth('created_at', date('m'))
        ->orderBy('view', 'desc')->get();

        return view('music.top-trending', compact('songs'));
    }

    public function searchFeature($search)
    {
        try {
            $songs = Song::searchName($search)->take(config('app.home_take_number'))->get();
            $albums = Album::searchName($search)->take(config('app.home_take_number'))->get();
            $artists = Artist::searchName($search)->take(config('app.home_take_number'))->get();
    
            return view('search', compact('songs', 'albums', 'artists', 'search'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('homePage.noSearchResult'));
        }
    }

    public function searchType($type, $search)
    {
        try {
            if ($type == 'song') {
                $songs = Song::searchName($search)->paginate(config('app.search_take_num'));

                return view('searchDetail', compact('songs', 'search'));
            } elseif ($type == 'album') {
                $albums = Album::searchName($search)->paginate(config('app.search_take_num'));

                return view('searchDetail', compact('albums', 'search'));
            } elseif ($type == 'artist') {
                $artists = Artist::searchName($search)->paginate(config('app.search_take_num'));

                return view('searchDetail', compact('artists', 'search'));
            }
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('homePage.noSearchResult'));
        }
    }
}
