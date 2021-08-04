<?php

namespace App\Repositories\Album;

interface IAlbumRepository
{
    public function delFavAlbum($id);

    public function getAlbumNew();

    public function getAlbumHot();

    public function searchName($search);
    
    public function searchAlbum($search);
    
    public function pinHotAlbum($action, $id);

    public function showSongsInAlbum($album);

    public function addSongToAlbum($album, $song);

    public function delSongInAlbum($album, $song);
}
