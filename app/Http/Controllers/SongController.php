<?php
namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Comment;
use App\Models\Lyric;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Throwable;

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
            $cate_id = $song->cate_id;
            $comments = Comment::orderBy('created_at', 'asc')->get();
            $countComment = Comment::countComment();
            $cate_songs = Song::OfCategory($cate_id)->get();

            return view('music.detail', compact('song', 'cate_songs', 'comments', 'countComment'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('home.notId'));
        }
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

    public function addLyric(Request $request)
    {
        $lyric = new Lyric();
        $lyric->content = $request->get('content');
        $lyric->song_id = $request->get('song_id');
        $lyric->user_id = $request->get('user_id');
        $lyric->save();
    }
}
