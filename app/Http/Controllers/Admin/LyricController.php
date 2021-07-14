<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lyric;
use App\Models\Song;
use Throwable;
use Illuminate\Support\Facades\DB;
use App\Repositories\Lyric\ILyricRepository;

class LyricController extends Controller
{
    protected $lyricRepository;

    public function __construct(ILyricRepository $lyricRepository)
    {
        $this->lyricRepository = $lyricRepository;
    }

    public function index()
    {
        $lyrics = $this->lyricRepository->all();

        return view('admin.lyric.index', compact('lyrics'));
    }

    public function create()
    {
        $songs = $this->lyricRepository->getNoLyricSongs();

        return view('admin.lyric.create', compact('songs'));
    }

    public function store(Request $request)
    {
        try {
            $this->lyricRepository->create($request->all());

            return redirect()->route('lyric.index')->with('success', trans('lyric.addSuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.noAdd'));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $lyric = $this->lyricRepository->findOrFail($id);
            $songs = $this->lyricRepository->getSongHasLyric();

            return view('admin.lyric.update', compact('lyric', 'songs'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.notId'));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $result = $this->lyricRepository->update($id, $request->all());

            return redirect()->route('lyric.index')->with('success', trans('lyric.updatesuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.Noupdate'));
        }
    }

    public function destroy($id)
    {
        try {
            $this->lyricRepository->destroy($id);

            return redirect()->route('lyric.index')->with('success', trans('lyric.deleteSuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.noDelete'));
        }
    }

    public function action($action, $id)
    {
        try {
            $this->lyricRepository->setLyricStatus($action, $id);

            return redirect()->back()->with('success', trans('lyric.active'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.noactive'));
        }
    }
}
