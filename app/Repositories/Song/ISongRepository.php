<?php

namespace App\Repositories\Song;

interface ISongRepository
{
    public function getAllArtist();
    public function getAllCategory();
    public function getArtist($id);
    public function getCategory($id);
    public function actionHot($action, $id);
}
