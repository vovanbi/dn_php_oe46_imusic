<?php

namespace App\Http\Controllers\Admin;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\SongRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Repositories\Song\ISongRepository;

class SongController extends Controller
{
    protected $songRepository;

    public function __construct(ISongRepository $songRepository)
    {
        $this->songRepository = $songRepository;
    }

    public function index()
    {
        $songs = $this->songRepository->showAll();

        return view('admin.song.index', compact('songs'));
    }

    public function create()
    {
        $categories = $this->songRepository->getAllCategory();
        $artists = $this->songRepository->getAllArtist();

        return view('admin.song.create', compact('categories', 'artists'));
    }

    public function store(SongRequest $request)
    {
        try {
            $this->songRepository->create($request->all());

            return redirect()->route('songs.index')->with('success', trans('song.addSuccess'));
        } catch (Throwable $e) {
            return redirect()->route('songs.index')->with('danger', trans('song.notAdd'));
        }
    }

    public function edit($id)
    {
        try {
            $song = $this->songRepository->findOrFail($id);
            $categories = $this->songRepository->getCategory($id);
            $artists = $this->songRepository->getArtist($id);

            return view('admin.song.update', compact('song', 'categories', 'artists'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('song.editError'));
        }
    }

    public function update(SongRequest $request, $song)
    {
        try {
            $this->songRepository->update($song, $request->all());

            return redirect()->route('songs.index')->with('success', trans('song.editSuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('song.editError'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->songRepository->destroy($id);

            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {

            return redirect()->back()->with('danger', trans('song.nodel'));
        }
    }

    public function action($action, $id)
    {
        try {

            $this->songRepository->actionHot($action, $id);

            return redirect()->back()->with('success', trans('lyric.active'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.noactive'));
        }
    }
}
