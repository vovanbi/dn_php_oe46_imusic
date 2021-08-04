<?php

namespace App\Repositories\Playlist;

interface IPlaylistRepository
{
    public function addAlbum($id);
    public function getAlbumUser();
    public function getPlaylistUser();
    public function addSonginPlaylist($id, $idSong);
    public function delSonginPlaylist($id, $idSong);
    public function addFavoriteSong($idSong);
    public function songResult($id, $search);
}
