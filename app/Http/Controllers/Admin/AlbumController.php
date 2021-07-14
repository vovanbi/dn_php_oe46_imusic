<?php

namespace App\Http\Controllers\Admin;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\AlbumRequest;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::orderBy('id')->paginate(config('app.paginate_num'));

        return view('admin.album.index', compact('albums'));
    }

    public function create()
    {
        return view('admin.album.create');
    }

    public function store(AlbumRequest $request)
    {
        $album = new Album;
        $album->name = $request->name;
        $image = $request->image;
        $image_path = 'image_album/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/image_album');
        $image->move($path, $image_path);
        $album->image = $image_path;
        $album->save();

        return redirect()->route('albums.index')->with('success', trans('album.addSuccess'));
    }

    public function edit($album)
    {
        try {
            $album = Album::find($album);

            return view('admin.album.update', compact('album'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.editError'));
        }
    }

    public function update(AlbumRequest $request, $album)
    {
        try {
            $album = Album::find($album);
            $album->name = $request->name;
            $image = $request->image;
            $image_path = 'image_album/' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/image_album');
            $image->move($path, $image_path);
            $album->image = $image_path;
            $album->save();

            return redirect()->route('albums.index')->with('success', trans('album.esditSuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.editError'));
        }
    }

    public function destroy($id)
    {
        $album = Album::destroy($id);
        
        return response()->json([
            'error' => false,
            'album'  => $album,
        ], 200);
    }

    public function albumSong($album)
    {
        try {
            $album = Album::find($album);
            $songs = $album->songs()->paginate(config('app.paginate_num'));

            return view('admin.album.albumSong', compact('album', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.notFoundAlbum'));
        }
    }

    public function getAddSong($album)
    {
        try {
            $album = Album::find($album);
            $songs = Song::orderBy('id')->paginate(config('app.paginate_num'));

            return view('admin.album.addAlbumSong', compact('album', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.notFoundAlbum'));
        }
    }

    public function addAlbumSong($album, $song)
    {
        try {
            $album = Album::find($album);
            $album->songs()->attach($song);

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
            $album = Album::find($album);
            $album->songs()->detach($song);

            return response()->json([
                'error' => false,
                'album'  => $album,
            ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('album.delSongError'));
        }
    }
}
