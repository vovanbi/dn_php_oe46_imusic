<?php

namespace App\Repositories\Lyric;

interface ILyricRepository
{
    public function getNoLyricSongs();

    public function getSongHasLyric();

    public function setLyricStatus($action, $id);
}
