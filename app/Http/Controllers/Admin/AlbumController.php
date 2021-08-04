<?php

namespace App\Http\Controllers\Admin;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Album\IAlbumRepository;
use App\Repositories\Song\ISongRepository;

class AlbumController extends Controller
{
    protected $albumRepository;
    protected $songRepository;

    public function __construct(
        IAlbumRepository $albumRepository,
        ISongRepository $songRepository
    ) {
        $this->albumRepository = $albumRepository;
        $this->songRepository = $songRepository;
    }

    public function index()
    {
        $albums = $this->albumRepository->all();

        return view('admin.album.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(AlbumRequest $request)
    {
        $album = $this->albumRepository->create($request->all());

        return redirect()->route('albums.index')->with('success', trans('album.addSuccess'));
    }

    public function edit($album)
    {
        try {
            $album = $this->albumRepository->findOrFail($album);

            return view('admin.album.update', compact('album'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.editError'));
        }
    }

    public function update(AlbumRequest $request, $album)
    {
        try {
            $album = $this->albumRepository->update($request->all(), $album);

            return redirect()->route('albums.index')->with('success', trans('album.esditSuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.editError'));
        }
    }

    public function destroy($id)
    {
        return $this->albumRepository->destroy($id);
    }

    public function action($action, $id)
    {
        try {
            $album = $this->albumRepository->pinHotAlbum($action, $id);

            return redirect()->back()->with('success', trans('lyric.active'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.noactive'));
        }
    }

    public function albumSong($album)
    {
        try {
            $songs = $this->albumRepository->showSongsInAlbum($album);
            $album = $this->albumRepository->findOrFail($album);

            return view('admin.album.albumSong', compact('album', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.notFoundAlbum'));
        }
    }

    public function getAddSong($album)
    {
        try {
            $album = $this->albumRepository->findOrFail($album);
            $songs = $this->songRepository->showAll();

            return view('admin.album.addAlbumSong', compact('album', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.notFoundAlbum'));
        }
    }

    public function addAlbumSong($album, $song)
    {
        try {
            $album = $this->albumRepository->addSongToAlbum($album, $song);

            return response()->json([
                'error' => false,
                'album'  => $album,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.addSongError'));
        }
    }

    public function delAlbumSong($album, $song)
    {
        try {
            $album = $this->albumRepository->delSongInAlbum($album, $song);

            return response()->json([
                'error' => false,
                'album'  => $album,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.delSongError'));
        }
    }

    public function markAsRead($id)
    {
        $result = $this->albumRepository->markAsRead($id);
        
        return response()->json([
            'error' => false,
            'result'  => $result,
        ], 200);
    }
}
