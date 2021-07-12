<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lyric;
use App\Models\Song;
use Throwable;
use Illuminate\Support\Facades\DB;

class LyricController extends Controller
{

    public function index()
    {
        $lyrics = Lyric::getLyric()->paginate(config('app.paginateUser'));
        return view('admin.lyric.index', compact('lyrics'));
    }

    public function create()
    {
        $lyricParent = Lyric::where('id', '=', config('app.userParent'))->get();
        $songs = Song::has('lyrics', 0)->get();

        return view('admin.lyric.create', compact('songs', 'lyricParent'));
    }

    public function store(Request $request)
    {
        try {
            $lyric = new Lyric();
            $lyric->song_id = $request->song_id;
            $lyric->content = $request->content;
            $lyric->user_id = auth()->user()->id;
            $lyric->save();

            return redirect()->route('lyric.index')->with('susccess', trans('lyric.addSuccess'));
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
            $lyricParent = Lyric::where('id', '=', config('app.userParent'))->get();
            $lyric = Lyric::findOrFail($id);
            $songs = Song::has('lyrics')->get();

            return view('admin.lyric.update', compact('lyric', 'songs', 'lyricParent'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.notId'));
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $lyric = Lyric::findOrFail($id);
            $lyric->song_id = $request->song_id;
            $lyric->content =$request->content;
            $lyric->user_id = auth()->user()->id;
            $lyric->save();

            return redirect()->route('lyric.index')->with('susccess', trans('lyric.updatesuccess'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.Noupdate'));
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $lyric = Lyric::findOrFail($id);
            $lyric->delete();
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
            $lyric = Lyric::findOrFail($id);
            switch ($action) {
                case 'active':
                    $lyric->status = $lyric->status ? config('app.Hidden') : config('app.Show');
                    $lyric->save();
                    break;
            }

            return redirect()->back()->with('success', trans('lyric.active'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('lyric.noactive'));
        }
    }
}
