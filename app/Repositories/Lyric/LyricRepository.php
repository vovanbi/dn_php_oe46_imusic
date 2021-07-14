<?php

namespace App\Repositories\Lyric;

use App\Models\Song;
use App\Models\Lyric;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class LyricRepository extends BaseRepository implements ILyricRepository
{
    public function getModel()
    {
        return Lyric::class;
    }

    public function all()
    {
        $lyrics = $this->model::getLyric()->paginate(config('app.paginateUser'));

        return $lyrics;
    }

    public function getNoLyricSongs()
    {
        $songs = Song::has('lyrics', config('app.noLyric'))->get();
        
        return $songs;
    }

    public function create($data)
    {
        $user_id = Auth::user()->id;

        $lyric = $this->model::create([
            'song_id' => $data['song_id'],
            'content' => $data['content'],
            'user_id' => $user_id,
        ]);

        return $lyric;
    }

    public function getSongHasLyric()
    {
        $songs = Song::has('lyrics')->get();

        return $songs;
    }

    public function update($id, $data)
    {
        $lyric = $this->findOrFail($id);
        $user_id = Auth::user()->id;

        if ($lyric) {
            $lyric->update([
                'song_id' => $data['song_id'],
                'content' => $data['content'],
                'user_id' => $user_id,
            ]);

            return $lyric;
        }

        return false;
    }

    public function setLyricStatus($action, $id)
    {
        $lyric = $this->findOrFail($id);

        if ($lyric) {
            switch ($action) {
                case 'active':
                    $lyric->status = $lyric->status ? config('app.lyric_hidden') : config('app.lyric_show');
                    $lyric->save();
                    break;
            }
    
            return $lyric;
        }
        
        return false;
    }
}
