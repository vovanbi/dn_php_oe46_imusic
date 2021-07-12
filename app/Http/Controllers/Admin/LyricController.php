<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lyric;

class LyricController extends Controller
{

    public function index()
    {
        return view('admin.lyric.index');
    }

    public function create()
    {
        //
        return view('admin.lyric.create');
    }

    public function store(Request $request)
    {
        $lyric = new Lyric();
        $lyric->song_id = $request->song_id;
        $lyric->content = $request->content;
        $lyric->user_id = rand(1, 10);
        $lyric->save();
        return redirect()->route('lyric.index')->with('susccess', 'Add success');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
