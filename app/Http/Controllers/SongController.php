<?php
namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SongController extends Controller
{

    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function detailSong($id)
    {
        try {
            $song = Song::findOrFail($id);
            $comments = Comment::orderBy('created_at', 'asc')->get();
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('home.Notid'));
        }

        return view('music.detail', compact('song', 'comments'));
    }

    public function storeComent(Request $request)
    {
        $comnent = new Comment();
        $comnent->rate_star = $request->get('rate_star');
        $comnent->content   = $request->get('content');
        $comnent->song_id   = $request->get('song_id');
        $comnent->user_id   = $request->get('user_id');
        $comnent->save();
    }
}
