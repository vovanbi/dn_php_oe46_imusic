<?php

namespace App\Repositories\Song;

interface ISongRepository
{
    public function getAllArtist();
    public function getAllCategory();
    public function getArtist($id);
    public function getCategory($id);
    public function actionHot($action, $id);
    public function getSongNew();
    public function songPlaying($id);
    public function getSongofCategory($id);
    public function getSongHot();
    public function topTrending();
    public function searchName($search);
    public function searchSong($search);
}
