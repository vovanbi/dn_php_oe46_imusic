<?php

namespace App\Repositories\Artist;

interface IArtistRepository
{
    public function getArtistSong();
    public function searchName($search);
    public function searchArtist($search);
}
