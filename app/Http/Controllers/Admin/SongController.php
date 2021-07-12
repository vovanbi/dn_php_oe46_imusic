<?php

namespace App\Http\Controllers\Admin;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\SongRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::orderBy('id')->paginate(config('app.paginate_num'));

        return view('admin.song.index', compact('songs'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $artists = Artist::orderBy('name')->get();

        return view('admin.song.create', compact('categories', 'artists'));
    }

    public function store(SongRequest $request)
    {
        $song = new Song;
        $song->cate_id = $request->cate_id;
        $song->name = $request->name;
        $song->artist_id = $request->art_id;
        $song->link = $request->link;
        $image = $request->image;
        $image_path = 'image_song/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/image_song');
        $image->move($path, $image_path);
        $song->image = $image_path;
        $song->save();

        return redirect()->route('songs.index')->with('success', trans('song.addSuccess'));
    }

    public function edit($song)
    {
        try {
            $song = Song::find($song);
            $cate_id = $song->category->id;
            $art_id = $song->artist->id;
            $categories = Category::orderBy('name')->where('id', '!=', $cate_id)->get();
            $artists = Artist::orderBy('name')->where('id', '!=', $art_id)->get();

            return view('admin.song.update', compact('song', 'categories', 'artists'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('song.editError'));
        }
    }

    public function update(SongRequest $request, $song)
    {
        try {
            $song = Song::find($song);
            $song->cate_id = $request->cate_id;
            $song->name = $request->name;
            $song->artist_id = $request->art_id;
            $song->link = $request->link;
            $image = $request->image;
            $image_path = 'image_song/' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/image_song');
            $image->move($path, $image_path);
            $song->image = $image_path;
            $song->save();

            return redirect()->route('songs.index')->with('success', trans('song.editSuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('song.editError'));
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $song = Song::findOrFail($id);
            $song->lyrics()->delete();
            $song->comments()->delete();
            foreach ($song->albums as $album) {
                $album->users()->delete();
            }
            $song->albums()->delete();
            $song->delete();
            DB::commit();

            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {
            DB::rollBack();
        }
    }

    public function action($action, $id)
    {
        try {
            $song = Song::findOrFail($id);
            switch ($action) {
                case 'hot':
                    $song->hot = $song->hot ? 0 : 1;
                    $song->save();
                    break;
            }

            return redirect()->back()->with('success', trans('lyric.active'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.noactive'));
        }
    }
}
