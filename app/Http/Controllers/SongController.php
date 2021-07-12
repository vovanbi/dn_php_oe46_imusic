<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Throwable;
use App\Repositories\Song\ISongRepository;
use App\Repositories\Comment\ICommentRepository;
use App\Repositories\Lyric\ILyricRepository;

class SongController extends Controller
{
    protected $songRepository;
    protected $commentRepository;
    protected $lyricRepository;

    public function __construct(
        ISongRepository $songRepository,
        ICommentRepository $commentRepository,
        ILyricRepository $lyricRepository
    ) {
        $this->songRepository = $songRepository;
        $this->commentRepository = $commentRepository;
        $this->lyricRepository = $lyricRepository;
        $this->middleware('auth');
    }

    public function detailSong($id)
    {
        try {
            $song = $this->songRepository->findOrFail($id);
            $cate_id = $song->cate_id;
            $cate_songs = $this->songRepository->getSongofCategory($cate_id);
            $comments = $song->comments;
            $countComment = $song->comments->count();


            return view('music.detail', compact('song', 'cate_songs', 'comments', 'countComment'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('home.notId'));
        }
    }

    public function storeComent(Request $request)
    {

        $comment = $this->commentRepository->create($request->all());
        $message = trans('home.rating');

        return response()->json(['comment'=>$comment,'message'=>$message], 200);
    }

    public function addLyric(Request $request)
    {
        $lyric = $this->lyricRepository->create($request->all());
        $message = trans('lyric.addSuccess');

       return response()->json(['lyric'=> $lyric, 'message'=>$message], 200);
    }
}
