<?php

namespace App\Repositories\Song;

use App\Models\Song;
use App\Models\Artist;
use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Song\ISongRepository;
use Illuminate\Support\Facades\File;

class SongRepository extends BaseRepository implements ISongRepository
{
    public function getModel()
    {
        return Song::class;
    }

    public function showAll()
    {
        $songs =$this->model::orderByid()->paginate(config('app.paginate_num'));

        return $songs;
    }

    public function create($data)
    {
        $image = $data['image'];
        $image_path = 'image_product/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/image_product');
        $image->move($path, $image_path);

        $song = $this->model::create([
            'name' => $data['name'],
            'cate_id'=>$data['cate_id'],
            'image' =>$image_path,
            'link'=>$data['link'],
            'artist_id' => $data['art_id']
        ]);

        return $song;
    }

    public function getAllArtist()
    {
        return Artist::all();
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function getArtist($id)
    {
        $song = $this->findOrFail($id);
        return Artist::where('id', $song->artist->id);
    }

    public function getCategory($id)
    {
        $song = $this->findOrFail($id);
        return Category::where('id', $song->category->id);
    }

    public function update($id, $data)
    {
        $song = $this->findOrFail($id);
        $image = $data['image'];

        if (File::exists(public_path('storage/' .  $song->image_path))) {
            File::delete(public_path('storage/' . $song->image_path));
        }

        $image_path = 'image_product/' . time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('/storage/image_product');

        $image->move($path, $image_path);

        $song = $song->update([
            'name' => $data['name'],
            'cate_id'=>$data['cate_id'],
            'image' =>$image_path,
            'link'=>$data['link'],
            'artist_id' => $data['art_id']
        ]);

        return $song;
    }

    public function delete($id)
    {
        $song = $this->findOrFail($id);
        $song->lyrics()->delete();
        $song->comments()->delete();
        $song->albums()->wherePivot('song_id', $song->id)->detach();
        $song->playLists()->wherePivot('song_id', $song->id)->detach();
        $song->delete();
    }

    public function actionHot($action, $id)
    {
        $song = $this->findOrFail($id);
        switch ($action) {
            case 'hot':
                $song->hot = $song->hot ? config('app.notHot') : config('app.Hot');
                $song->save();
                break;
        }
    }
}