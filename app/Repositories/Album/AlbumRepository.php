<?php

namespace App\Repositories\Album;

use App\Models\Album;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Album\IAlbumRepository;

class AlbumRepository extends BaseRepository implements IAlbumRepository
{
    public function getModel()
    {
        return Album::class;
    }

    public function delFavAlbum($id)
    {
        return  Auth::user()->albums()->detach($id);
    }
}
