<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Category\ICategoryRepository;
use App\Repositories\Song\ISongRepository;
use App\Repositories\Album\IAlbumRepository;
use App\Repositories\Artist\IArtistRepository;

class HomeController extends Controller
{
    protected $albumReporitory;
    protected $artistRepository;
    protected $songRepository;
    protected $categoryRepository;

    public function __construct(
        IAlbumRepository $albumReporitory,
        ICategoryRepository $categoryRepository,
        ISongRepository $songRepository,
        IArtistRepository $artistRepository
    ) {
        $this->albumReporitory = $albumReporitory;
        $this->categoryRepository = $categoryRepository;
        $this->songRepository = $songRepository;
        $this->artistRepository = $artistRepository;
    }
    public function changeLanguage($locale)
    {
        App::setlocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllParentCategory();
        $songs = $this->songRepository->getSongNew();
        $albums = $this->albumReporitory->getAlbumNew();
        $artists = $this->artistRepository->getArtistSong();

        return view('home', compact('songs', 'albums', 'artists', 'categories'));
    }

    public function songPlaying($id)
    {
        try {
            $song = $this->songRepository->songPlaying($id);

            return view('song-play', compact('song'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('homePage.songNotFound'));
        }
    }

    public function getSong($id)
    {
        $songs = $this->songRepository->getSongofCategory($id);
        $songs = $songs->map(function ($item) {
            $item->setAttribute('artist_name', $item->artist->name);

            return $item;
        });

        return response()->json($songs, 200);
    }

    public function renderHome(Request $request)
    {
        $songs = $this->songRepository->getSongNew();
        $albums = $this->albumReporitory->getAlbumNew();
        $artists = $this->artistRepository->getArtistSong();

        return response()->json(['songs' => $songs, 'artists' => $artists , 'albums' => $albums], 200);
    }

    public function hotAlbumMusic($type)
    {
        if ($type == "song") {
            $songs = $this->songRepository->getSonghot();
            return response()->json(['songs' => $songs], 200);
        }
        if ($type == "album") {
            $albums = $this->albumReporitory->getAlbumHot();
            return response()->json(['albums' => $albums], 200);
        }
    }

    public function topTrending()
    {
        $songs = $this->songRepository->topTrending();

        return view('music.top-trending', compact('songs'));
    }

    public function searchFeature($search)
    {
        try {
            $songs = $this->songRepository->searchName($search);
            $albums = $this->albumReporitory->searchName($search);
            $artists = $this->artistRepository->searchName($search);
    
            return view('search', compact('songs', 'albums', 'artists', 'search'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('homePage.noSearchResult'));
        }
    }

    public function searchType($type, $search)
    {
        try {
            if ($type == 'song') {
                $songs = $this->songRepository->searchSong($search);

                return view('searchDetail', compact('songs', 'search'));
            } elseif ($type == 'album') {
                $albums = $this->albumReporitory->searchAlbum($search);

                return view('searchDetail', compact('albums', 'search'));
            } elseif ($type == 'artist') {
                $artists = $this->artistRepository->searchArtist($search);

                return view('searchDetail', compact('artists', 'search'));
            }
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('homePage.noSearchResult'));
        }
    }
}
