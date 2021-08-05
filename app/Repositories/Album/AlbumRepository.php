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

    public function getAlbumNew()
    {
        return $this->model::orderBy('created_at', 'desc')->take(config('app.home_take_number'))->get();
    }

    public function getAlbumHot()
    {
        return $this->model->songHot();
    }

    public function searchName($search)
    {
        return $this->model->searchName($search)->take(config('app.home_take_number'))->get();
    }

    public function searchAlbum($search)
    {
        return $this->model->searchName($search)->paginate(config('app.search_take_num'));
    }
}
